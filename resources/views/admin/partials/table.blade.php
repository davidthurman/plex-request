@section('content')
    <form method="post" action="">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Title</th>
            <th>User</th>
            <th>Requested on</th>
            <th>Status</th>
        </tr>
        @foreach($requests as $request)
        <tr>
            <td>{{ $request->title }}</td>
            <td>{{ $request->user }}</td>
            <td>{{ $request->created_at }}</td>
            <td>{{ $request->status }}</td>
        </tr>
        @endforeach
    </table>
</form>
@endsection