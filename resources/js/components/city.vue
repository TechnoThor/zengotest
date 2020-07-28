<template>
    <div class="chat-bottom">
        <div @click="showOff" v-if="success != ''" class="alert alert-success" role="alert">
            <p>1 kép kiválasztva</p>
        </div>
        <form @submit="formSubmit" enctype="multipart/form-data" class="d-inline-flex w-100">
            <span class="w-fit-content d-inline-flex">
                <input @click="showOff" type="file" class="d-none" accept="image/x-png,image/gif,image/jpeg" ref="fileInput" v-on:change="onImageChange">
                <img src="/images/photo.png" class="imageupload" @click="$refs.fileInput.click()">
                <span @click="showOn" class="emoji-container">
                    <Emoji @click="selectedEmoji" :open="show"/>
                </span>
            </span>
            <input  @click="showOff" id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" >
            <button @click="showOff" class="btn btn-success" id="btn-chat">Küldés</button>
        </form>


    </div>
</template>

<script>
    import { VueChatEmoji, emojis } from 'vue-chat-emoji'
    require("vue-chat-emoji/dist/vue-chat-emoji.css");
    export default {
        components: {
            Emoji: VueChatEmoji
        },
        props: ['userid','userid2'],

        mounted() {

        },
        data() {
            return {
                newMessage: '',
                image: '',
                success: '',
                show:false,
            }
        },

        methods: {
            showOn(){
              this.show=true;
            },
            showOff(){
                this.show=false;
            },
            onImageChange(e){
                this.image = e.target.files[0];
                this.success = e.target.files[0];
            },
            selectedEmoji(args) {
              this.show=true;
              $('#btn-input').val($('#btn-input').val()+args.emoji);
              this.newMessage+=args.emoji;
            },

            formSubmit(e) {
                e.preventDefault();
                if ($('#btn-input').val()!="" || this.image!=''){
                    this.$emit('messagesent', {
                        userid: this.userid,
                        userid2: this.userid2,
                        message: this.newMessage,
                        image: this.image,
                    });
                    this.newMessage = '';
                    this.image = '';
                    this.success = '';
                }


            }

        }
    }
</script>
