@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
            @if(!$errors->isEmpty())
            <h2>Reported errors:</h2>
            <table class="table table-hover">
                <tr>
                    <td>Name:</td>
                    <td>Date:</td>
                    <td>Description:</td>
                </tr>
                @foreach ($errors as $error)
                <tr>
                    <td>{{ $error->name }}</td>
                    <td>{{ $error->date }}</td>
                    <td>{{ $error->description }}</td>
                </tr>
                @endforeach
            </table>
            @else
            <h2>No errors reported.</h2>
            @endif
            <hr>
            @if(!$requests->isEmpty())
                <h2>Current requests:</h2>
                <form method="POST" action="{{ route('deleterequest') }}">
                    @foreach ($requests as $request)
                        {{ $request->title }}<br><span class="pull-right"><a href="{{ route('deleterequest') }}">x</a></span>
                        <hr>
                    @endforeach
                </form>
            @else
                <h2>No requests submitted.</h2>
            @endif
        </div>
    @else
        <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
            <h2>You shouldn't be seeing this, someone messed up.</h2>
        </div>
    @endif
@stop