@extends('layout.admin')
@section('title')Admin @stop
@section('content')
<div class="container">

    <p>There are {{ $counts['errors'] }} errors, {{ $counts['users'] }} users, and {{ $counts['requests'] }} total requests.</p>

</div>
@stop