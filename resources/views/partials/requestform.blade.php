<form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('submitrequest') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="year">Year released:</label>
        <input type="text" class="form-control" id="year" name="year" autofocus>
    </div>
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <button type="submit" id="submit" class="btn btn-primary">Submit request</button>
</form>