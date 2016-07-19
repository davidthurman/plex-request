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
                <ul class="nav navbar-nav pull-left">
                    <li class="navbar-welcome"><a href="/">Hello {{ Auth::user()->name }}!</a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="plexnavbar">
                <ul class="nav navbar-nav pull-right">
                    @if(Auth::user()->isAdmin())
                        <li @if($activepage == 'admin')class="activepage"@endif><a href="/admin">Admin</a></li>
                    @endif
                    <li @if($activepage == 'search')class="activepage"@endif><a href="/search">Search</a></li>
                    <li @if($activepage == 'userrequests')class="activepage"@endif><a href="/userrequests">Requests</a></li>
                    <li @if($activepage == 'reporterror')class="activepage"@endif><a href="/reporterror">Report error</a></li>
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