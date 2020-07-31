<template>
        <div class="row cities-table border-1 p-4" v-if="currentCounty.name">
            <div class="col-12" >
                <p class="uppercase">Megye: <span class="text-light">{{currentCounty.name}}</span></p>
            </div>
            <div class="col-12" >
                <p class="uppercase mb-0">Városok:</p>
            </div>
            <div class="col-12" v-for="(city, index) in currentCities">
                <div class="d-inline-flex w-100" v-if="currentIndex===index && countyId===city.countyId">
                    <form @submit="formSubmit"  class="d-inline-flex w-100">
                        <input id="btn-input" type="text" class="form-control h-auto p-1 uppercase w-100" placeholder="A város neve" v-model="currentCity" >
                        <div class="action d-inline-flex">
                            <a @click="deleteCity(city.id)" class="btn btn-danger text-white">Törlés</a>
                            <button class="btn btn-primary text-white" id="btn-chat">Módosítás</button>
                        </div>
                    </form>
                    <div class="action">
                        <a @click="cancel()" class="btn bg-light">Mégse</a>
                    </div>
                </div>

                <div v-else>
                    <p class="city-name text-light p-1 m-0 w-100 uppercase" @click="changeField(index,city.name,city.id,city.countyId)">{{city.name}}</p>
                </div>
            </div>
        </div>
</template>

<script>

    export default {
        props: ['currentCities','currentCounty'],
        data() {
            return {
                actionbar: null,
                row: null,
                currentIndex: null,
                currentCityId: null,
                currentCity: null,
                countyId: null,
            }
        },
        methods:{
            deleteCity: function (id) {
                this.$emit('delete-city', {
                    'id': id,
                });
                this.currentCity=null;
                this.currentIndex=null;
                this.currentCityId=null;

                this.$emit('get-cities');
            },
            changeField: function(index,currentCity,currentCityId,countyId) {
                this.countyId=countyId;
                this.currentCity=currentCity;
                this.currentIndex=index;
                this.currentCityId=currentCityId;
            },
            cancel: function() {
                this.currentCity=null;
                this.currentIndex=null;
                this.currentCityId=null;
            },
            formSubmit(e) {
                e.preventDefault();
                if(this.currentCity!==""){
                    this.$emit('edit-city', {
                        id: this.currentCityId,
                        name: this.currentCity
                    });
                    this.$emit('get-cities');
                }



            }
        },
    }

</script>
