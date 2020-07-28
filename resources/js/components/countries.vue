<template>
    <form @submit="formSubmit">
        <div class="form-group">
            <label for="exampleFormControlSelect">Countries</label>
            <select class="form-control" id="exampleFormControlSelect">
                <option>1</option>
                <option>2</option>
            </select>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['userid','userid2'],

        data() {
            return {

            }
        },

        methods: {
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
