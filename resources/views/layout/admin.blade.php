<html>
<head>
    <title>@yield('title') | Plex Requests</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

    <div class="nav-side-menu">
        <div class="brand">Plex Request Admin</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <a href="/admin">
                    <li @if($path == 'admin')class="active"@endif>
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </li>
                </a>

                <a href="/admin/requests/">
                    <li  @if($path == 'admin/requests')class="active"@endif>
                        <i class="fa fa-film fa-lg"></i> Requests</i>
                    </li>
                </a>

                <a href="/admin/users">
                    <li @if($path == 'admin/users')class="active"@endif>
                        <i class="fa fa-users fa-lg"></i> Users
                    </li>
                </a>

                <a href="/admin/errors">
                    <li @if($path == 'admin/errors')class="active"@endif>
                        <i class="fa fa-exclamation fa-lg"></i> Errors
                    </li>
                </a>

                <a href="/search">
                    <li>
                        <i class="fa fa-sign-out fa-lg"></i> Exit
                    </li>
                </a>
            </ul>
        </div>
    </div>
    @include('partials.success')
    @include('partials.failure')
    <div class="admin-section">
        @yield('content')
    </div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#flashMessage")
                .delay(5000)
                .slideUp("slow");
    });
</script>
@yield('jsadditions')
</body>
</html>
