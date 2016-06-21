@if (Auth::check())
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/">
                    <img class="plexlogo" src="{{ asset('/images/plexlogo.png') }}">
                </a>
                @if(Auth::check())
                    Welcome, {{ Auth::user()->name }}!
                @endif
            </div>
            <ul class="nav navbar-nav pull-right">
                @if (Auth::user()->isAdmin())
                    <li><a href="/admin">Admin</a></li>
                @endif
                <li><a href="/search">Search</a></li>
                <li><a href="/userrequests">Requests</a></li>
                <li><a href="/reporterror">Report error</a></li>
                <li><a href="/logout">Log out</a></li>
            </ul>
        </div>
    </nav>
@else
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/search">
                    <img class="plexlogo" src="{{ asset('/images/plexlogo.png') }}">
                </a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <li><a href="/register">Register</a></li>
                <li><a href="/login">Log in</a></li>
            </ul>
        </div>
    </nav>
@endif
