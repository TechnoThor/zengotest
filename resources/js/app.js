require('./bootstrap');

window.Vue = require('vue');

Vue.component('counties', require('./components/countries.vue').default);
Vue.component('city-form', require('./components/cityForm.vue').default);
Vue.component('cities', require('./components/cities.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        cities: [],
        currentCities: [],
        currentCounty: {},
        message:null,
        showinput:false,

    },

    methods: {

        //az alert box értékét vezérli, ha van visszajelzés, megjelenítit azt
        setMessage(newValue) {
            this.message = newValue;
            // Close after 5 seconds
            setTimeout(() => {
                this.message = null;
            }, 5000);
        },

        //első használatkó az alap php-vel betöltődő városokat rendszerezi és változóba tölti
        renderCities(data) {
            objArray=[];
            cityObj={};
            data.startcities.forEach(function(city) {
                cityObj = {
                    "id": parseInt(city.id),
                    "name": city.name,
                    "countyId": city.county_id
                };
                objArray.push(cityObj);
            });
            this.cities=objArray;
        },
        //kiveszi az adott megyéhez listázandó városokat
        getCitiesSelect(data) {
            var currentCounty=data.county;
            objArray=[];
            this.cities.forEach(function(city) {
                if(city.countyId===currentCounty.id){
                    objArray.push(city);
                }
            });

            this.currentCounty=currentCounty;
            this.currentCities=objArray;
        },

        //az összes városbol kiválogatja megye id szerint, hogy melyikeket kell megjelníteni
        getCities() {
            var currentCounty=this.currentCounty;
            objArray=[];
            this.cities.forEach(function(city) {
                if(city.countyId===currentCounty.id){
                    objArray.push(city);
                }
            });
            this.currentCities=objArray;
        },

        //a megyére kattintás után a változó módosításával jellenik meg a város hozzáadása lehetőség
        showInput(data) {
            this.showinput=parseInt(data.currentId)==0?false:true;
        },

        deleteCity(data) {
            this.cities.slice(2,1)
            let formData = new FormData();
            var tempArray=[];
            var tmpcities=this.cities;
            formData.append('id', data.id);
            axios.post('/deletecity', formData).then(response => {
                response.data.alert===''?'':this.setMessage(response.data.alert);
                tmpcities.forEach(function(city){
                    if (city.id !== data.id) {
                        tempArray.push(city);
                    }
                });
                this.cities=tempArray;
                this.getCities();
            });



        },

        addCity(data) {
            let formData = new FormData();
            formData.append('countyId', this.currentCounty.id);
            formData.append('name', data.name);

            axios.post('/addcity',formData).then(response => {
                response.data.alert===''?'':this.setMessage(response.data.alert);
                var cityObj = {};
                var id=response.data.id===null?'':response.data.id;
                cityObj = {
                    "id": parseInt(id),
                    "name": data.name,
                    "countyId": this.currentCounty.id
                };
                this.cities.push(cityObj);
                this.getCities()
            });

        },

        editCity(data) {
            let formData = new FormData();
            formData.append('id', data.id);
            formData.append('name', data.name);

            axios.post('/editcity', formData).then(response => {
                response.data.alert === '' ? '' : this.setMessage(response.data.alert);
                this.cities.forEach(function(city){
                    if (city.id === data.id) {
                        city.name = data.name;
                    }
                });
            });
            this.getCities()
        }
    },

});

