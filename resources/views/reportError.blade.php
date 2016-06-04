@extends('partials.master')

@section('content')
    @if (Auth::check())
        <p>Hello {{ Auth::user()->name }}! Report an error:</p>
    @else
        <p>You shouldn't be seeing this, someone messed up.</p>
    @endif
@stop