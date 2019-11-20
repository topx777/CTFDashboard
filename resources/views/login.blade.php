<!doctype html>
<html lang="en">

<head>
<title>Oculux | Login</title>
<meta charset="utf-8">
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
                <h4>LOGIN</h4>
                <p class="lead"><small>Ingrese sus credenciales CTF</small></p>
                <form class="form-auth-small m-t-20" action="">
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input autofocus type="email" class="form-control round" id="signin-email" value="" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control round" id="signin-password" value="" placeholder="Password">
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox">
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-round btn-block">LOGIN</button>
                    <div class="bottom">
                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
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
</body>
</html>
