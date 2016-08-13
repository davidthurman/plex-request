@extends('layout.master')
@section('title')Your requests @stop
@section('content')
@if(!$requests->isEmpty())
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <h2>Your unfulfilled requests:</h2>
            @foreach($requests as $request)
                <div class="col-md-4">
                    @if($request->media_type == 'movie')
                        <a href="https://www.themoviedb.org/movie/{{ $request['tmdbid'] }}" target="new"><img src="{{ $request->getPosterPath($request['tmdbid'], $request->media_type) }}"></a>
                    @elseif($request->media_type == 'tv')
                        <a href="https://www.themoviedb.org/tv/{{ $request['tmdbid'] }}" target="new"><img src="{{ $request->getPosterPath($request['tmdbid'], $request->media_type) }}"></a>
                    @endif
                    {{ date('M d, Y', strtotime($request['created_at'])) }}
                </div>
            @endforeach
    </div>
@else
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <h2>You haven't submitted any requests yet.</h2>
    </div>
@endif
@stop