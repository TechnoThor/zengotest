<template>
    <div v-if="cities.length">
        <h3>MEGYE: {{county.name}}</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(city, index) in this.cities">
                <th scope="row">{{index+1}}</th>
                <td>{{city.name}}</td>
                <td><a @click="deleteCity(city.id,county.id)" class="btn btn-danger">Törlés</a>
                <a @click="editCity(city.id,county.id)" class="btn btn-primary">Szerkesztés</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default {
        props: ['cities','county'],
        methods:{
            deleteCity: function (id,countyId) {

                    this.$emit('delete-city', {
                        'id': id,
                        'countyId':countyId
                    });
                    this.$emit('fetch-cities', {
                        countyId: countyId,
                    });
                }

            },


    }

</script>
