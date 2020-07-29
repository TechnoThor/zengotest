<template>
        <div class="form-group">
            <label for="exampleFormControlSelect">Counties</label>
            <select v-model="choosed" @change="show(choosed),fetchCities(choosed)" class="form-control"  id="exampleFormControlSelect">
                <option :value="0">Válasszon</option>
                <option v-for="(county, index) in this.counties" :value="county.id">
                    {{ county.name }}
                </option>
            </select>
        </div>
</template>

<script>
    export default {
        props: ['counties'],

        data: function () {
            return {
                choosed:'0',
            }
        },
        created() {
            this.fetchCounty();
        },
        methods:{
            fetchCounty: function () {
                this.$emit('fetch-counties');
            },
            fetchCities: function (countyId) {
                    this.$emit('fetch-cities', {
                        countyId: countyId,
                    });
            },
            show: function (number) {

                    this.$emit('showinput', {
                        number: number,
                    });
            },

        }

    }
</script>
