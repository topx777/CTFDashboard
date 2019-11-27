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

<body class="theme-cyan font-montserrat box_layout h-menu">

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

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <div id="megamenu" class="megamenu particles_js">
            <a href="javascript:void(0);" class="megamenu_toggle btn btn-danger"><i class="icon-close"></i></a>
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mega-card">
                            <h6 class="title">General Settings</h6>
                            <ul class="setting-list list-unstyled mb-0">
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span>Anyone follow me</span>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <span>Email Redirect</span>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <span>Notifications</span>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span>Auto Updates</span>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <span>Offline</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mega-card">
                            <h6 class="title">Quick Link</h6>
                            <ul class="guick_link">
                                <li><a href="javascript:void(0);" title="">Home</a></li>
                                <li><a href="javascript:void(0);" title="">About Us</a></li>
                                <li><a href="javascript:void(0);" title="">FAQs</a></li>
                                <li><a href="javascript:void(0);" title="">Privacy Policy</a></li>
                                <li><a href="javascript:void(0);" title="">Sitemap</a></li>
                                <li><a href="javascript:void(0);" title="">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mega-card">
                            <h6 class="title">Contact Us</h6>
                            <form>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="input-group mb-2">
                                    <textarea type="text" class="form-control" placeholder="Message"
                                        rows="2"></textarea>
                                </div>
                                <button type="button" class="btn btn-primary btn-round">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mega-card">
                            <h6 class="title">Image Gallery</h6>
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{asset('images/image-gallery/7.jpg')}}"
                                            alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('images/image-gallery/8.jpg')}}"
                                            alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('images/image-gallery/9.jpg')}}"
                                            alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="card mt-4">
                        <div class="header">
                            <h2>FAQs</h2>
                            <ul class="header-dropdown dropdown">
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="accordion" id="accordion-faqs">
                                <div>
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne-faqs" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Q: How to use SCSS variables to build custom color <span
                                                    class="float-right badge  badge-primary">23</span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne-faqs" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion-faqs">
                                        <div class="body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et.
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseTwo-faqs" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Q: Four questions to ask about your DevOps strategy <span
                                                    class="float-right badge  badge-success">8</span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo-faqs" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion-faqs">
                                        <div class="body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa Leggings occaecat craft beer farm-to-table,
                                            raw denim aesthetic synth nesciunt you probably haven't heard of them
                                            accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseThree-faqs" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Q: A comparison of microservices and functional programming concepts
                                                <span class="float-right badge  badge-danger">13</span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree-faqs" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion-faqs">
                                        <div class="body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high Brunch 3 wolf moon
                                            tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                            wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                                            vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                            synth nesciunt you probably haven't heard of them accusamus labore
                                            sustainable VHS.
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

        

        <div id="">
            <div class="container">
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
                if (teams.length>0) {
                let pos=1;
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
                                        4
                                    </td>
                                    <td class="w40 px-5 text-center">
                                        ${team.score}
                                    </td>
                                </tr>`);
                    pos+=1;
                });
    
                }
              }
        </script>
</body>

</html>