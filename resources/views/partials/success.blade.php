@if (Session::has('success'))
    <div id="flashMessage" class="flash">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif