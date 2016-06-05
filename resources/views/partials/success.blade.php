@if (Session::has('success'))
    <div id="flashMessage" class="flash col-xs-12 col-md-6 col-md-offset-3">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif