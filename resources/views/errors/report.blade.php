@extends('master')
@section('title')Report an error @stop
@section('content')
<div class="container">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <h2>Report a problem with the server:</h2>
        <form role="form" method="POST" action="{{ route('submiterror') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="date">Date encountered:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="message">Describe the error:</label>
                <textarea class="form-control" id="message" name="description" maxlength="500" rows="7"></textarea>
                <p id="characterLeft" class="help-block ">You have reached the limit</p>
            </div>
            <button type="submit" id="submit" name="btnSubmit" class="btn btn-plex pull-right">Submit Form</button>
        </form>
    </div>
</div>
@stop