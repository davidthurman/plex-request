<table class="table table-bordered table-hover table-striped">
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