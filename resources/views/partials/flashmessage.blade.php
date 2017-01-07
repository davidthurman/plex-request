@if (Session::has('success'))
    <div id="flashMessage" class="flash">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (Session::has('failure'))
    <div id="flashMessage" class="failure">
        <div class="alert alert-danger">
            {{ session('failure') }}
        </div>
    </div>
@endif