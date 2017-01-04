@if (Session::has('failure'))
    <div id="flashMessage" class="failure">
        <div class="alert alert-danger">
            {{ session('failure') }}
        </div>
    </div>
@endif