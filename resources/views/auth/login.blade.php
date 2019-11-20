<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<title>{{ config('app.name', 'CTFDashboard') }} - Login</title>
<meta charset="utf-8">

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
<meta name="author" content="GetBootstrap, design by: puffintheme.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/animate-css/vivify.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('css/site.min.css')}}">

</head>
<body class="theme-cyan font-montserrat">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<div class="pattern">
    <span class="red"></span>
    <span class="indigo"></span>
    <span class="blue"></span>
    <span class="green"></span>
    <span class="orange"></span>
</div>

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="card">
            <div class="body">
                <h4>LOGIN CTF</h4>
                <p class="lead"><small>Ingrese sus credenciales</small></p>
                <div id="JSONresp" class="alert alert-danger" style="display: none;" role="alert">
                </div>
                <form class="form-auth-small m-t-20" id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username" class="control-label sr-only">Username</label>
                        <input autofocus type="username" class="form-control round" id="username" value="{{ old('username') }}" name="username" placeholder="Username" required autocomplete="username" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control round" id="password" value="" placeholder="Password" name="password" required autocomplete="password">
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Recordarme</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-round btn-block">INICIAR</button>
                    <div class="bottom">
                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="#">¿Olvidaste tu contraseña?</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->
    
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script>    
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
<script>
$(document).on('submit', '#loginForm', function (e) {
    e.preventDefault();

    let form = $(this);
    let formURL = $(form[0]).attr('action');

    let formData = new FormData(form[0]);

    $.ajax({
        type: "POST",
        url: formURL,
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (response) {
            if (response.auth) {
                window.location.href = response.intended;
            } else {
                $('#JSONresp').show();
                $('#JSONresp').text(response.msgError);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
});
</script>
</body>
</html>
