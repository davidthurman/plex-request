@extends('layout.admin')
@section('title')Admin @stop
@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h2>Reported errors:</h2>
            <br>
            <table class="table table-hover table-bordered">
                <tr class="active">
                    <td>Name:</td>
                    <td>Date:</td>
                    <td>Description:</td>
                    <td>Resolve:</td>
                </tr>
                @foreach ($errors as $error)
                    <tr>
                        <td>{{ $error->name }}</td>
                        <td>{{ $error->date }}</td>
                        <td>{{ $error->description }}</td>
                        <td class="text-center"><a href="{{ route('resolveerror', $error->id) }}"><button class="btn btn-xs btn-warning">x</button></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop