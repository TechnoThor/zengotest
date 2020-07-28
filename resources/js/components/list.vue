<template>
    <ul v-if="nosub==false" class="chat" id="chat" v-chat-scroll="{always: false, smooth: true}">
        <li class="left clearfix" v-for="(message, index) in this.messages">
            <span class="d-block w-100">
                <p class="text-right w-100 mb-0 pr-3" v-if="message.checked==1 && messages.length-1==index && message.user_id==userid">Látta</p>
                <div v-if="message.user_id==userid2" class="chat-body clearfix other-message" v-on:click="showDetails(message.id)">
                    <p v-if="message.message!==''" class="mb-1">{{ message.message }}</p>
                    <div class="image-send-chat" v-on:click="show(message.image)" v-if="message.image!=='' && message.image!=='loading.gif'" v-bind:style="{ 'background-image': 'url(/images/chat/' + message.image + ')' }"></div>
                        <div class="image-send-chat" v-if="message.image=='loading.gif'" v-bind:style="{ 'background-image': 'url(/images/chat/' + message.image + ')' }"></div>
                    <span class="details-chat left date d-none" v-bind:id="message.id" >
                        <p>{{ message.created_at }}</p>
                    </span>
                </div>
                <div v-else class="chat-body clearfix own-message" v-on:click="showDetails(message.id)">
                    <p v-if="message.message!==''" class="mb-1">{{ message.message }}</p>
                    <div class="image-send-chat" v-on:click="show(message.image)" v-if="message.image!=='' && message.image!=='loading.gif'" v-bind:style="{ 'background-image': 'url(/images/chat/' + message.image + ')' }"></div>
                    <div class="image-send-chat"  v-if="message.image=='loading.gif'" v-bind:style="{ 'background-image': 'url(/images/chat/' + message.image + ')' }"></div>
                    <span class="details-chat date d-none" v-bind:id="message.id">
                        <span class="d-inline-flex">
                            <img src="/images/delete.png" class="delete-icon" v-on:click="deleteMessage(message.id)">
                            <p>{{ message.created_at }}</p>
                        </span>
                    </span>
                </div>
            </span>
        </li>
        <div class="modal d-none">
            <div class="modal-container"></div>
        </div>
    </ul>

    <div v-else class="card-body row pb-5 pt-5">
        <div class="col-md-12">
            <h3 class="header-title text-center">Ahhoz, hogy csevegni tudj valakivel elő kell fizetned nálunk</h3>
        </div>
        <div class="col-md-4 mt-5 mb-5">
            <form method="POST" action="/paypal">
                <input type="hidden" :value="this.$csrf.get()"  name="_token"/>
                <button type="submit" class="payment-button">
                    <div class="card payments">
                        <div class="payment-card-header">
                            <h5>1 Hónap</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text text-justify">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p><b>6 500 USD</b></p>
                            <input value="1" type="hidden" name="type">
                        </div>
                    </div>
                </button>
            </form>
        </div>
        <div class="col-md-4 mt-5 mb-5">
            <form method="POST" action="/paypal">
                <input type="hidden" :value="this.$csrf.get()"  name="_token"/>
                <button type="submit" class="payment-button">
                    <div class="card payments best-price">
                        <div class="payment-card-header">
                            <h5>3 Hónap</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text text-justify">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p><b>10 500 USD</b></p>
                            <input value="2" type="hidden" name="type">
                        </div>
                    </div>
                </button>
            </form>
        </div>
        <div class="col-md-4 mt-5 mb-5">
            <form method="POST" action="/paypal">
                <input type="hidden" :value="this.$csrf.get()"  name="_token"/>
                <button type="submit" class="payment-button">
                    <div class="card payments">
                        <div class="payment-card-header">
                            <h5>1 Év</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text text-justify">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p><b>13 500 USD</b></p>
                            <input value="3" type="hidden" name="type">
                        </div>
                    </div>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    import VueChatScroll from 'vue-chat-scroll'
    Vue.use(VueChatScroll)
    import VueCsrf from 'vue-csrf';
    Vue.use(VueCsrf);


    $(document).mouseup(function(e)
    {
        var container = $(".modal-image");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            if(!$('.modal').hasClass('d-none')){
                $('.modal').addClass('d-none');
                $('.modal-container').html('')
            }
        }
    });
    export default {
        props: ['messages','nosub','userid','userid2','csrf'],

        created() {
            this.selectUsers();
            Echo.private('chat')
                .listen('MessageSent', (e) => {
                    this.selectUsers();
                    this.scrollToEnd();
                });
        },

        methods:{
            show (name) {
                if($('.modal').hasClass('d-none')){
                    $('.modal').removeClass('d-none')
                    $('.modal-container').html("<img class='modal-image' src='/images/chat/"+name+"'>");
                }else{
                    $('.modal').addClass('d-none');
                    $('.modal-container').html('')
                }
            },
            scrollToEnd: function () {
                var container = document.getElementById("chat");
                container.scrollTop = container.scrollHeight;
            },

            selectUsers: function () {
                this.$emit('messagefetch', {
                    userid: this.userid,
                    userid2: this.userid2,
                });
            },


            deleteMessage: function (messageid) {
                if (this.nosub==false){
                    let formData1 = new FormData();
                    formData1.append('messageid', messageid);
                    axios.post('/deleteMessage',formData1).then(response => {
                        console.log(response);
                    });
                    this.selectUsers();
                }

            },

            showDetails: function (detailsid) {

                let item=$('#'+detailsid);

                if (item.hasClass('d-none')) {
                    item.removeClass("d-none");
                    item.addClass('d-block');
                } else {
                    item.removeClass("d-block");
                    item.addClass('d-none');
                }

            },


        }

    };


</script>
