@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            @include('partials.requestform')

            @if(!empty($json))
                <hr>
                <img src="{{ $json['Poster'] }}"><br>
                <h3>{{ $json['Title'] }}</h3>
                <h3>{{ $json['Year'] }}</h3>
            @endif
        </div>
    @endif
@stop