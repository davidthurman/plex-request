@if (Session::has('failure'))
    <div id="flashMessage" class="failure col-xs-12 col-md-6 col-md-offset-3">
        <div class="alert alert-danger">
            {{ session('failure') }}
        </div>
    </div>
@endif