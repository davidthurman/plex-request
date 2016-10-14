<html>
<head>
    <title>@yield('title') | Plex Requests</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ asset('/js/ace-extra.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>
    <div class="nav-side-menu">
        <div class="brand">Plex Request Admin</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li @if($path == '/admin')class="active"@endif>
                    <a href="/admin">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-film fa-lg"></i> Requests <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu" id="requests">
                    <li @if($path == 'admin/requests/pending')class="active"@endif><a href="/admin/requests/pending">Pending</a></li>
                    <li @if($path == 'admin/requests/filled')class="active"@endif><a href="/admin/requests/filled">Filled</a></li>
                    <li @if($path == 'admin/requests/declined')class="active"@endif><a href="/admin/requests/declined">Declined</a></li>
                </ul>

                <li>
                    <a href="/admin/users">
                        <i class="fa fa-users fa-lg"></i> Users
                    </a>
                </li>

                <li>
                    <a href="/admin/errors">
                        <i class="fa fa-exclamation fa-lg"></i> Errors
                    </a>
                </li>

                <li>
                    <a href="/search">
                        <i class="fa fa-sign-out fa-lg"></i> Exit
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @include('partials.success')
    @include('partials.failure')
    @yield('content')

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
