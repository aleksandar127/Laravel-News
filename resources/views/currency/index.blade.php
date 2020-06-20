@extends('layouts.articles')
@section('content')

<table class="table">
    <thead>
        <tr><th class="text-center" colspan="4">  {{$currency['date']}}</th></tr>
        <tr>
        <th scope="col">CURRENCY DESIGNATION</th>
        <th scope="col">BUYING EXCHANGE RATE</th>
        <th scope="col">MIDDLE EXCHANGE RATE</th>
        <th scope="col">SELLING EXCHANGE RATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($currency as $keys=>$values)
        <tr>
        @if(is_array($values))
        <td>{{$keys}}</td>
        @foreach($values as $key => $value)
            <td>{{$value}}</td>
        @endforeach

        @endif
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
