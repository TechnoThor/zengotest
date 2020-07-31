@extends('layouts.app')
@section('title')
<title>Zengo Test</title>
@stop

@section('links')
<link rel="stylesheet" href="/css/style.css">
@stop

@section('content')
<div id='app'>
    <div class="container-fluid">
        <div class="row canvas">
            <div class="col-md-5">
                <counties @render-cities="renderCities" @get-cities-select="getCitiesSelect" :cities="{{$cities}}" :counties="{{$counties}}"  @showinput="showInput"></counties>
                <city-form @add-city="addCity" @get-cities="getCities" :showinput="showinput" :message="message"></city-form>
            </div>
            <div class="col-md-7">
                <cities @get-cities="getCities" :current-cities="currentCities" :current-county="currentCounty" @edit-city="editCity" @delete-city="deleteCity"></cities>
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
