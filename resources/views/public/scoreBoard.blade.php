<!doctype html>
<html lang="en">

<head>
    <title>ScoreBoard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/animate-css/vivify.min.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/site.min.css')}}">
    <style>
        .flip-list-move {
            transition: transform 1s;
        }
    </style>
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

        <div class="container p-5">
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
                            <div id="flip-list-demo" class="table-responsive">
                                <table class="table table-hover table-custom spacing8 text-white">
                                    <thead>
                                        <tr class="font-18">
                                            <th class="text-center font-weight-bolder">#</th>
                                            <th class="font-weight-bolder text-left">Equipo</th>
                                            <th class="text-center font-weight-bolder">Banderas</th>
                                            <th class="text-center font-weight-bolder">Puntos</th>
                                        </tr>
                                    </thead>
                                    <tbody is="transition-group" name="flip-list">
                                        <tr v-for="team in teams" v-bind:key="team.id">
                                            <td class="w60 text-center">
                                                @{{ team.position }}
                                            </td>
                                            <td class="text-left">
                                                <span>@{{team.name}}</span>
                                            </td>
                                            <td class="w40 px-5 text-center">
                                                @{{team.flags}}
                                            </td>
                                            <td class="w40 px-5 text-center">
                                                @{{team.score}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="particles-js"></div>
    </div>
    <!-- END WRAPPER -->

    <script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
    <script src="{{asset('js/scoreboard.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.14.1/lodash.min.js"></script>
    <script>
        // $(function () {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.get("{{route('team.teamsScore')}}",
        //         function (data, textStatus, jqXHR) {
        //             setOrden(data.teamsScoreBoard)
        //         },
        //         "JSON"
        //     );
        // });

        // function setOrden(teams) {
        //     if (teams.length > 0) {
        //         let pos = 1;
        //         $('#teamScore').html('');
        //         teams.forEach(team => {
        //             $('#teamScore').append(` <tr>
        //                 <td class="w60 text-center">
        //                     ${pos}
        //                 </td>
        //                 <td>
        //                     <span>${team.name}</span>
        //                 </td>
        //                 <td class="w40 px-5 text-center">
        //                     ${team.flag}
        //                 </td>
        //                 <td class="w40 px-5 text-center">
        //                     ${team.score}
        //                 </td>
        //             </tr>`);
        //             pos += 1;
        //         });
        //     }
        // }

    </script>
</body>

</html>