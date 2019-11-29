<!doctype html>
<html lang="en">

<head>
    <title>ScoreBoard</title>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
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

    <!-- <div class="particles-js">
        <div id="teamDashboardScore">
            <div class="row clearfix">
                <div class="py-2 col-12">
                    <div class="col-12">
                        <h2 class="text-info">
                            Tabla de Posiciones
                        </h2>
                        <hr class="bg-info">
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8 text-white">
                                <thead>
                                    <tr class="font-18">
                                        <th class="text-center font-weight-bolder">#</th>
                                        <th class="font-weight-bolder">Equipo</th>
                                        <th class="text-center font-weight-bolder">Banderas</th>
                                        <th class="text-center font-weight-bolder">Puntos</th>
                                    </tr>
                                </thead>
                                <tbody class="font-15" id="teamScore">
                                    {{-- <tr>
                                            <td class="w60 text-center">
                                                1
                                            </td>
                                            <td>
                                                <span>N0mb13-Equ1p0</span>
                                            </td>
                                            <td class="w40 px-5 text-center">
                                                4
                                            </td>
                                            <td class="w40 px-5 text-center">
                                                22520
                                            </td>
                                        </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="particles-js"></div>
    </div> -->

    <div class="auth_brand particles_js">
        <div class="vivify popIn">
            <div class="card">
                <div class="body">
                    <div id="teamDashboardScore">
                        <div class="row clearfix">
                            <div class="py-2 col-12">
                                <div class="col-12">
                                    <h2 class="text-info">
                                        Tabla de Posiciones
                                    </h2>
                                    <hr class="bg-info">
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom spacing8 text-white">
                                            <thead>
                                                <tr class="font-18">
                                                    <th class="text-center font-weight-bolder">#</th>
                                                    <th class="font-weight-bolder">Equipo</th>
                                                    <th class="text-center font-weight-bolder">Banderas</th>
                                                    <th class="text-center font-weight-bolder">Puntos</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-15" id="teamScore">
                                                {{-- <tr>
                                                    <td class="w60 text-center">
                                                        1
                                                    </td>
                                                    <td>
                                                        <span>N0mb13-Equ1p0</span>
                                                    </td>
                                                    <td class="w40 px-5 text-center">
                                                        4
                                                    </td>
                                                    <td class="w40 px-5 text-center">
                                                        22520
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="particles-js"></div>
    </div>

    <!-- Javascript -->
    <script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
    <script src="{{asset('js/scoreboard.js')}}"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get("{{route('team.teamsScore')}}",
                function (data, textStatus, jqXHR) {
                    setOrden(data.teamsScoreBoard)
                },
                "JSON"
            );
        });

        function setOrden(teams) {
            if (teams.length > 0) {
                let pos = 1;
                $('#teamScore').html('');
                teams.forEach(team => {
                    $('#teamScore').append(` <tr>
                        <td class="w60 text-center">
                            ${pos}
                        </td>
                        <td>
                            <span>${team.name}</span>
                        </td>
                        <td class="w40 px-5 text-center">
                            ${team.flag}
                        </td>
                        <td class="w40 px-5 text-center">
                            ${team.score}
                        </td>
                    </tr>`);
                    pos += 1;
                });
            }
        }

    </script>
</body>

</html>
