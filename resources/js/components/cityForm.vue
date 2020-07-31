<template>
    <div v-if="showinput" class="row border-1 p-4 mb-3">
        <div class="col-12">
            <form @submit="formSubmit" enctype="multipart/form-data" class="d-block w-100 mb-0 w-100">
                <div class="d-inline-flex w-100">
                    <label for="inputCity" class="mt-auto mb-auto mr-2 uppercase">Új város:</label>
                    <input type="text" id="inputCity" class="form-control h-auto  uppercase p-1 bg-dark text-white ml-auto mr-0 w-75" placeholder="" v-model="newCity" >
                </div>
                <div class="w-100 text-right">
                    <button class="btn w-75 bg-light" id="btn-chat">felvesz</button>
                </div>
            </form>
            <div v-if="message!=null" class="alert alert-warning w-100">{{message}}</div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['message','showinput'],
        data() {
            return {
                newCity: '',
            }
        },

        methods: {
            formSubmit(e) {
                e.preventDefault();
                if (this.newCity!=''){
                    this.$emit('add-city', {
                        name: this.newCity
                    });
                    this.newCity="";
                    this.$emit('get-cities');
                }
            }


        }

    }
</script>
