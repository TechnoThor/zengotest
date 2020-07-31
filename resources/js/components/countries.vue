<template>
    <div class="row border-1 p-4">
        <div class="col-12">
            <div class="form-group d-inline-flex mb-0 w-100">
                <label for="FormControlSelect" class="mt-auto mb-auto mr-2 uppercase">Megye:</label>
                <select v-model="choosed" @change="show(choosed)" class="form-control p-1 h-auto uppercase bg-dark text-white ml-auto mr-0 w-75"  id="FormControlSelect">
                    <option :value="0">Válasszon</option>
                    <option  v-for="(county, index) in counties" :value="county.id">
                        {{ county.name }}
                    </option>
                </select>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['counties','cities'],

        data: function () {
            return {
                choosed:'0',
            }
        },
        created() {
            this.renderCities(this.cities)
        },
        methods:{
            renderCities: function (cities) {
                this.$emit('render-cities', {
                    startcities: cities,
                });
            },

            show: function (currentId) {
                this.$emit('showinput', {
                    currentId: currentId,
                });

                var countyObj={};
                this.counties.forEach(function(county) {
                    if(county.id===currentId){
                        countyObj = {
                            "id": parseInt(county.id),
                            "name": county.name,
                        };
                    }
                });

                this.$emit('get-cities-select', {
                    county: countyObj,

                });
            },

        }

    }
</script>
