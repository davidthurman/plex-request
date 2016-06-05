@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            @include('partials.requestform')

            @if(!empty($json))
                <hr>
                <form role="form" method="POST" action="{{ route('submitrequest') }}">
                    {{ csrf_field() }}
                <div>
                    <input type ="image" src="{{ $json['Poster'] }}" required>
                    <input id="title" hidden="true" name="title" readonly="readonly" value="{{ $json['Title'] }}">
                    <input id="year" hidden="true" name="year" readonly="readonly" value="{{ $json['Year'] }}">
                    <h3>{{ $json['Title'] }}</h3>
                  

                </div>
                
                <h3>{{ $json['Year'] }}</h3>
            @endif
        </div>
    @endif
@stop