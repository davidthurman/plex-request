@if (Auth::check())
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#plexnavbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/">
                    <img class="plexlogo" src="{{ asset('/images/plexlogo.png') }}">
                </a>
                @if(Auth::check())
                    <span id="navbarwelcome">Welcome, {{ Auth::user()->name }}!</span>
                @endif
            </div>
            <div class="collapse navbar-collapse" id="plexnavbar">
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
        </div>
    </nav>
@else
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#plexnavbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/search">
                    <img class="plexlogo" src="{{ asset('/images/plexlogo.png') }}">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="plexnavbar">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="/register">Register</a></li>
                    <li><a href="/login">Log in</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endif
