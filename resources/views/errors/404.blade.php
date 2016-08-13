@extends('layout.master')
@section('title')Page not found! @stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1>Page Not Found - Error 404</h1>
                <br />
                <p>The page you requested could not be found, either contact the admin or try again.</p>
                <br>
                <a href="{{ route('home') }}" class="btn btn-large btn-plex">Take Me Home</a>
            </div>
        </div>
    </div>
@stop