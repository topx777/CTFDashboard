<!doctype html>
<html lang="en">

<head>
    <title>Oculux | Coming Soon</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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

    <div class="particles_js coming-soon">
        <div class="auth_div vivify fadeInTop w-75">
            <div class="card">
                <div class="body">
                    <div class="m-0auto text-center">
                        <p class="lead">Te sientes preparado?</p>
                        <div class="wsize2 row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <span class="s1-txt1">Days</span>
                                <div class="how-countdown">
                                    <span class="l1-txt1 p-b-9 days">35</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <span class="s1-txt1">Hours</span>
                                <div class="how-countdown">
                                    <span class="l1-txt1 p-b-9 hours">17</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <span class="s1-txt1">Minutes</span>
                                <div class="how-countdown">
                                    <span class="l1-txt1 p-b-9 minutes">50</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <span class="s1-txt1">Seconds</span>
                                <div class="how-countdown">
                                    <span class="l1-txt1 p-b-9 seconds">39</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pattern">
                        <span class="red"></span>
                        <span class="indigo"></span>
                        <span class="blue"></span>
                        <span class="green"></span>
                        <span class="orange"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="particles-js"></div>
    </div>
    <!-- END WRAPPER -->


    <!-- Javascript -->
    <script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>

    <script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>

    <script src="{{asset('vendor/countdowntime/moment.min.js')}}"></script>
    <script src="{{asset('vendor/countdowntime/moment-timezone.min.js')}}"></script>
    <script src="{{asset('vendor/countdowntime/moment-timezone-with-data.min.js')}}"></script>
    <script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
    <script>
        $('.wsize2').countdown100({
            /*Set Endtime here*/
            /*Endtime must be > current time*/
            endtimeYear: 0,
            endtimeMonth: 0,
            endtimeDate: 113,
            endtimeHours: 13,
            endtimeMinutes: 0,
            endtimeSeconds: 0,
            timeZone: "",
            // ex:  timeZone: "America/New_York"
            //go to " http://momentjs.com/timezone/ " to get timezone
        });
    </script>
</body>

</html>