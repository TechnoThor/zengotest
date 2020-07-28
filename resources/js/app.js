require('./bootstrap');

window.Vue = require('vue');

Vue.component('counties', require('./components/countries.vue').default);
//Vue.component('city', require('./components/city.vue').default);
//Vue.component('list', require('./components/list.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        cities: [],
        counties: [],
        csrf: null
    },

    methods: {
        fetchCities(countryId) {
            axios.get('/cities?county_id=\'+datas.countyId\'').then(response => {
                    this.cities = response.data.cities;
            });
        },
        fetchCountry() {
            axios.get('/counties').then(response => {
                this.countries = response.data.counties;
            });
        },

        addCity(countryId, city) {
            let formData = new FormData();
            formData.append('countyId', countyId);
            formData.append('city', city);

            axios.post('/city',formData).then(response => {
                this.cities.push(city);
                this.fetchCities(countyId);
            });

        }
    },

});

