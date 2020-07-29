require('./bootstrap');

window.Vue = require('vue');

Vue.component('counties', require('./components/countries.vue').default);
Vue.component('cityform', require('./components/cityForm.vue').default);
Vue.component('cities', require('./components/cities.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        cities: [],
        county:[],
        counties: [],
        newCity: 0,
        message:'alma',
        showinput:false
    },

    methods: {
        fetchCounty() {
            axios.get('/fetchcounties').then(response => {
                this.counties=response.data.counties;
            });
        },
        showInput(data) {
            this.showinput=parseInt(data.number)==0?false:true;
        },
        fetchCities(data) {
            axios.get('/fetchcities?countyid='+data.countyId).then(response => {
                    this.cities = response.data.cities;
                    this.county = response.data.county;
            });
        },
        deleteCity(data) {
            let formData = new FormData();
            formData.append('id', data.id);
            formData.append('countyId', data.countyId);
            axios.post('/deletecity', formData).then(response => {
                this.message=response.data.alert==''?'':response.data.alert;
            });
        },

        addCity(data) {

            let formData = new FormData();
            formData.append('countyId', data.countyId);
            formData.append('city', data.city);

            axios.post('/addcity',formData).then(response => {
                this.message=response.data.alert==''?'':response.data.alert;
            });

        }
    },

});

