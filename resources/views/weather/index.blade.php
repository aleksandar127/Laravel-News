@extends('layouts.articles')
@section('content')
    <img src="https://openweathermap.org/img/wn/{{$weather['weather'][0]['icon']}}@2x.png" class="text-primary">
    <p>{{round($weather['main']['temp'])}} C&deg;</p>
@endsection




