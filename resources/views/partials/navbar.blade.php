@if (Auth::check())
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/">
                    <img class="plexlogo" src="{{ asset('/images/plexlogo.png') }}">
                </a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <li><a href="#">Your requests</a></li>
                <li><a href="#">All requests</a></li>
                <li><a href="#">Report error</a></li>
            </ul>
        </div>
    </nav>
@else
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/">
                    <img class="plexlogo" src="{{ asset('/images/plexlogo.png') }}">
                </a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <li><a href="/register">Register</a></li>
            </ul>
        </div>
    </nav>
@endif
