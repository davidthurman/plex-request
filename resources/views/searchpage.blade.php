@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            <form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('searchrequest') }}">
                {{ csrf_field() }}
                <h2>Create new request:</h2>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" autofocus required>
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    @endif
@stop