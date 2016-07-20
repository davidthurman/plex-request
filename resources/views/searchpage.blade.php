@extends('layout.master')
@section('title')Search @stop
@section('content')
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('searchrequest') }}">
        {{ csrf_field() }}
        <h2>Create new request:</h2>
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