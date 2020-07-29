<template>

    <form v-if="showinput" @submit="formSubmit" enctype="multipart/form-data" class="w-100">
        <span class="d-inline-flex">
            <input id="btn-input" type="text"  class="form-control input-sm" placeholder="Type your message here..." v-model="newCity" >
            <button class="btn btn-success" id="btn-chat">Küldés</button>
        </span>
        <div class="alert alert-success w-100">{{message}}</div>
    </form>

</template>

<script>

    export default {
        props: ['county','message','showinput'],
        data() {
            return {
                newCity: '',
            }
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();

                    this.$emit('add-city', {
                        countyId: this.county.id,
                        city: this.newCity
                    });

                    this.$emit('fetch-cities', {
                        countyId: this.county.id,
                    });

            }


        }

    }
</script>
