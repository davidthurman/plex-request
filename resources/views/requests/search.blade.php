@extends('master')
@section('title')Search @stop
@section('content')
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('searchrequest') }}">
        {{ csrf_field() }}
        <h1>Search</h1>
        <h3>If you would like to submit a request for content to be added to the server, search and submit!</h3>
        <br>
        <select name="mediatype" class="form-control">
            <option value="movie">Movie</option>
            <option value="tv">TV Show</option>
        </select>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
        <button type="submit" id="submit" class="btn btn-plex">Search</button>
    </form>
</div>
@stop