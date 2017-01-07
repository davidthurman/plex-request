@extends('guest')
@section('title')Login @stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="{{ url('/login') }}" method="post" role="form" style="display: block;">
                                    {{ csrf_field() }}
                                    <h2>LOGIN</h2>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="col-xs-6 form-group pull-left checkbox">
                                        <input id="checkbox1" type="checkbox" name="remember">
                                        <label for="checkbox1">Remember Me</label>
                                    </div>
                                    <div class="col-xs-6 form-group pull-right">
                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                    </div>
                                </form>
                                <form id="register-form" action="{{ url('/register') }}" method="post" role="form" style="display: none;">
                                    {{ csrf_field() }}
                                    <h2>REGISTER</h2>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password-confirm" tabindex="2" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="registration_code" id="registration_code" tabindex="2" class="form-control" placeholder="Registration Code" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6 tabs">
                                <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
                            </div>
                            <div class="col-xs-6 tabs">
                                <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection