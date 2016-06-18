@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-8">
            @if(!$users->isEmpty())
            <h2>Users:</h2>
            <br>
            <table class="table table-hover table-bordered">
                <tr class="active">
                    <td>ID</td>
                    <td>Name</td>
                    <td>Admin?</td>
                    <td>Give admin?</td>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->admin == 1 or $user->id == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td><input id="adminCheckbox" type="checkbox" @if($user->admin == 1 or $user->id == 1) checked @endif><a class="adminSubmit noDisplay">SUBMIT</a></td>
                    </tr>
                @endforeach
            </table>
            @endif
            @if(!$errors->isEmpty())
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
            @else
            <h2>No errors reported.</h2>
            @endif
        </div>
        <div class="col-xs-12 col-md-4">
            @if(!$requests->isEmpty())
                <h2>Current requests:</h2>
                <br>
                <table class="table table-hover table-bordered">
                    
                        <tr class="active">
                            <td>Title:</td>
                            <td>Delete?</td>
                        </tr>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->title }}</td>
                                <td class="text-center"><a href="{{ route('deleterequest', $request->id) }}"><button>x</button></a></td>
                            </tr>
                        @endforeach
                    
                </table>
            @else
                <h2>No requests submitted.</h2>
            @endif
        </div>
    @else
        <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
            <h2>You shouldn't be seeing this, someone messed up.</h2>
        </div>
    @endif
    @section('jsadditions')
        <script type="text/javascript">
            $('#adminCheckbox').click(function() {
                $( ".adminSubmit" ).removeClass( "noDisplay" );
            });
        </script>
    @stop
@stop