@extends('layouts.app')
@section('title')
<title>Zengo Test</title>
@stop

@section('links')

@stop

@section('content')
<div id='app'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <counties @fetch-cities="fetchCities"  @fetch-counties="fetchCounty" :counties="counties" @showinput="showInput"></counties>
                <cityform @add-city="addCity" @fetch-cities="fetchCities" :showinput="showinput" :county="county" :message="message"></cityform>
            </div>
            <div class="col-md-7">
                <cities @fetch-cities="fetchCities" @delete-city="deleteCity" :cities="cities" :county="county"></cities>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="/js/app.js" ></script>
@stop
