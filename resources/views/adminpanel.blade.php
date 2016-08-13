@extends('layout.master')
@section('title')Admin @stop
@section('content')
    @if(!$users->isEmpty())
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h2>Users:</h2>
            <br>
            <form method="POST" action="{{ route('edituser') }}">
                {!! csrf_field() !!}
                <table class="table table-hover table-bordered">
                    <tr class="active">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Admin?</td>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('showuser', $user->id) }}">{{ $user->name }}</a></td>
                            <td>
                                <input type="hidden" id="admincheckbox" name="admincheckbox[{{$user->id}}]" value="0">
                                <input type="checkbox" id="admincheckbox" name="admincheckbox[{{$user->id}}]" value="1" @if($user->admin or $user->id ==1) checked @endif>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td><button class="btn btn-plex">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
    @endif
    @if(!$errors->isEmpty())
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h2>Reported errors:</h2>
            <br>
            <table class="table table-hover table-bordered">
                <tr class="active">
                    <td>Name:</td>
                    <td>Date:</td>
                    <td>Description:</td>
                    <td>Delete?</td>
                </tr>
                @foreach ($errors as $error)
                <tr>
                    <td>{{ $error->name }}</td>
                    <td>{{ $error->date }}</td>
                    <td>{{ $error->description }}</td>
                    <td class="text-center"><a href="{{ route('deleteerror', $error->id) }}"><button>x</button></a></td>
                </tr>
                @endforeach
            </table>
        </div>
    @endif
    @if(!$requests->isEmpty())
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h2>Current requests:</h2>
            <br>
            <table class="table table-hover table-bordered">
                <tr class="active">
                    <td>Title:</td>
                    <td>User:</td>
                    <td>Status:</td>
                    <td>Fill:</td>
                    <td>Decline:</td>
                </tr>
                @foreach ($requests as $request)
                    <tr>
                        @if($request->media_type == 'movie')
                            <td><a href="https://www.themoviedb.org/movie/{{ $request['tmdbid'] }}" target="new">{{ $request->title }}</a></td>
                        @elseif($request->media_type == 'tv')
                            <td><a href="https://www.themoviedb.org/tv/{{ $request['tmdbid'] }}" target="new">{{ $request->title }}</a></td>
                        @endif
                        <td>{{ $request->user }}</td>
                        <td>
                            @if($request->status == 0)Pending
                            @elseif($request->status == 1)Filled
                            @elseif($request->status == 2)Declined
                            @endif
                        </td>
                        <td class="text-center"><a href="{{ route('fillrequest', $request->id) }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></td>
                        <td class="text-center"><a href="{{ route('declinerequest', $request->id) }}"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@stop