@extends('partials.master')

@section('content')
    @if (Auth::check())
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        @include('partials.requestform')
        <h2>Your unfulfilled requests:</h2>

        @foreach($requests as $request)
            {{ $request->title }}<br>
        @endforeach
    </div>
    @else
    <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
        <h2>You shouldn't be seeing this, someone messed up.</h2>
    </div>
    @endif
@stop