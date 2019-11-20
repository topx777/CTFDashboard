<!DOCTYPE html>
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
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
<!-- Styles -->
<style>
    body {
        background-image: url("{{asset('images/worldback.jpg')}}");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
        width: 100%;
    }

    .title {
        font-size: 85px;
    }

    .text {
        color: #FEFEFE;
        text-shadow: 1px 2px 0px rgba(0,134,213, 0.5);
        font-family: 'Montserrat', sans-serif;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
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
    @if (Route::has('login'))
        <div class="top-right links">
                          
            <a class="float-right text" href="{{ route('login') }}">Login</a>
        
        </div>
    @endif
<div class="auth-main particles_js">            
                    <div class="content">
                        <h1 class="text m-b-md title">Plataforma CTF</h1>
                    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->
    
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script>    
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>
</body>
</html>
