@extends('layout.admin')
@section('title')Admin @stop
@section('content')
    <div class="container">
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
                                    <input type="checkbox" id="admincheckbox" name="admincheckbox[{{$user->id}}]" value="1" @if($user->admin or $user->id ==1) checked @endif onclick="changeAdminState()">
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
    </div>
@stop
@section('jsadditions')
<script type="text/javascript">

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (xhttp.readyState == 4 && xhttp.status == 200) {
document.getElementById("admincheckbox").innerHTML = xhttp.responseText;
}
};

function changeAdminState() {
xhttp.open("GET", "/admin/user/changeadminstate", true);
xhttp.send();
}

</script>
@stop