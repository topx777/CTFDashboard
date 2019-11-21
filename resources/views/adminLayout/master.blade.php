<!doctype html>
<html lang="en">

<head>
    <title>Oculux | Page Blank</title>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/animate-css/vivify.min.css')}}">
    @section('style')

    @show
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/site.min.css')}}">

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

    <!-- Theme Setting -->
    <div class="themesetting">
        <a href="javascript:void(0);" class="theme_btn"><i class="icon-magic-wand"></i></a>
        <div class="card theme_color">
            <div class="header">
                <h2>Theme Color</h2>
            </div>
            <ul class="choose-skin list-unstyled mb-0">
                <li data-theme="green">
                    <div class="green"></div>
                </li>
                <li data-theme="orange">
                    <div class="orange"></div>
                </li>
                <li data-theme="blush">
                    <div class="blush"></div>
                </li>
                <li data-theme="cyan" class="active">
                    <div class="cyan"></div>
                </li>
                <li data-theme="indigo">
                    <div class="indigo"></div>
                </li>
                <li data-theme="red">
                    <div class="red"></div>
                </li>
            </ul>
        </div>
        <div class="card font_setting">
            <div class="header">
                <h2>Font Settings</h2>
            </div>
            <div>
                <div class="fancy-radio mb-2">
                    <label><input name="font" value="font-krub" type="radio"><span><i></i>Krub Google
                            font</span></label>
                </div>
                <div class="fancy-radio mb-2">
                    <label><input name="font" value="font-montserrat" type="radio" checked><span><i></i>Montserrat
                            Google font</span></label>
                </div>
                <div class="fancy-radio">
                    <label><input name="font" value="font-roboto" type="radio"><span><i></i>Robot Google
                            font</span></label>
                </div>
            </div>
        </div>
        <div class="card setting_switch">
            <div class="header">
                <h2>Settings</h2>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    Light Version
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="lv-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    RTL Version
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="rtl-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    Horizontal Henu
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="hmenu-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    Mini Sidebar
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="mini-sidebar-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="form-group">
                <label class="d-block">Traffic this Month <span class="float-right">77%</span></label>
                <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77"
                        aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Server Load <span class="float-right">50%</span></label>
                <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">
        {{-- topNavbar --}}
        @include('adminLayout.components.topNavbar')

        <div class="search_div">
            <div class="card">
                <div class="body">
                    <form id="navbar-search" class="navbar-form search-form">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                                <a href="javascript:void(0);" class="search_toggle btn btn-danger"><i
                                        class="icon-close"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <span>Search Result <small class="float-right text-muted">About 90 results (0.47 seconds)</small></span>
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing5">
                    <tbody>
                        <tr>
                            <td class="w40">
                                <span>01</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avtar-pic w35 bg-red" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Avatar Name"><span>SS</span></div>
                                    <div class="ml-3">
                                        <a href="page-invoices-detail.html" title="">South Shyanne</a>
                                        <p class="mb-0">south.shyanne@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>02</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('images/xs/avatar2.jpg')}}" data-toggle="tooltip"
                                        data-placement="top" title="" alt="Avatar" class="w35 h35 rounded"
                                        data-original-title="Avatar Name">
                                    <div class="ml-3">
                                        <a href="javascript:void(0);" title="">Zoe Baker</a>
                                        <p class="mb-0">zoe.baker@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>03</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avtar-pic w35 bg-indigo" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Avatar Name"><span>CB</span></div>
                                    <div class="ml-3">
                                        <a href="javascript:void(0);" title="">Colin Brown</a>
                                        <p class="mb-0">colinbrown@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>04</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avtar-pic w35 bg-green" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Avatar Name"><span>KG</span></div>
                                    <div class="ml-3">
                                        <a href="javascript:void(0);" title="">Kevin Gill</a>
                                        <p class="mb-0">kevin.gill@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>05</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('images/xs/avatar5.jpg')}}" data-toggle="tooltip"
                                        data-placement="top" title="" alt="Avatar" class="w35 h35 rounded"
                                        data-original-title="Avatar Name">
                                    <div class="ml-3">
                                        <a href="javascript:void(0);" title="">Brandon Smith</a>
                                        <p class="mb-0">Maria.gill@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>06</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('images/xs/avatar6.jpg')}}" data-toggle="tooltip"
                                        data-placement="top" title="" alt="Avatar" class="w35 h35 rounded"
                                        data-original-title="Avatar Name">
                                    <div class="ml-3">
                                        <a href="javascript:void(0);" title="">Kevin Baker</a>
                                        <p class="mb-0">kevin.baker@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>07</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('images/xs/avatar2.jpg')}}" data-toggle="tooltip"
                                        data-placement="top" title="" alt="Avatar" class="w35 h35 rounded"
                                        data-original-title="Avatar Name">
                                    <div class="ml-3">
                                        <a href="javascript:void(0);" title="">Zoe Baker</a>
                                        <p class="mb-0">zoe.baker@example.com</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

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

        <div id="rightbar" class="rightbar">
            <div class="body">
                <ul class="nav nav-tabs2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Chat-one">Chat</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat-list">List</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat-groups">Groups</a></li>
                </ul>
                <hr>
                <div class="tab-content">
                    <div class="tab-pane vivify fadeIn delay-100 active" id="Chat-one">
                        <div class="slim_scroll">
                            <div class="chat_detail">
                                <ul class="chat-widget clearfix">
                                    <li class="left float-left">
                                        <div class="avtar-pic w35 bg-pink"><span>KG</span></div>
                                        <div class="chat-info">
                                            <span class="message">Hello, John<br>What is the update on Project X?</span>
                                        </div>
                                    </li>
                                    <li class="right">
                                        <img src="{{asset('images/xs/avatar1.jpg')}}" class="rounded" alt="">
                                        <div class="chat-info">
                                            <span class="message">Hi, Alizee<br> It is almost completed. I will send you
                                                an email later today.</span>
                                        </div>
                                    </li>
                                    <li class="left float-left">
                                        <div class="avtar-pic w35 bg-pink"><span>KG</span></div>
                                        <div class="chat-info">
                                            <span class="message">That's great. Will catch you in evening.</span>
                                        </div>
                                    </li>
                                    <li class="right">
                                        <img src="{{asset('images/xs/avatar1.jpg')}}" class="rounded" alt="">
                                        <div class="chat-info">
                                            <span class="message">Sure we'will have a blast today.</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="input-group p-t-15">
                                    <textarea rows="3" class="form-control" placeholder="Enter text here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane vvivify fadeIn delay-100" id="Chat-list">
                        <ul class="right_chat list-unstyled mb-0">
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-red"><span>FC</span></div>
                                        <div class="media-body">
                                            <span class="name">Folisise Chosielie</span>
                                            <span class="message">offline</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="{{asset('images/xs/avatar3.jpg')}}" alt="">
                                        <div class="media-body">
                                            <span class="name">Marshall Nichols</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-red"><span>FC</span></div>
                                        <div class="media-body">
                                            <span class="name">Louis Henry</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-orange"><span>DS</span></div>
                                        <div class="media-body">
                                            <span class="name">Debra Stewart</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-green"><span>SW</span></div>
                                        <div class="media-body">
                                            <span class="name">Lisa Garett</span>
                                            <span class="message">offline since May 12</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="{{asset('images/xs/avatar5.jpg')}}" alt="">
                                        <div class="media-body">
                                            <span class="name">Debra Stewart</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="{{asset('images/xs/avatar2.jpg')}}" alt="">
                                        <div class="media-body">
                                            <span class="name">Lisa Garett</span>
                                            <span class="message">offline since Jan 18</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-indigo"><span>FC</span></div>
                                        <div class="media-body">
                                            <span class="name">Louis Henry</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-pink"><span>DS</span></div>
                                        <div class="media-body">
                                            <span class="name">Debra Stewart</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-info"><span>SW</span></div>
                                        <div class="media-body">
                                            <span class="name">Lisa Garett</span>
                                            <span class="message">offline since May 12</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane vivify fadeIn delay-100" id="Chat-groups">
                        <ul class="right_chat list-unstyled mb-0">
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-cyan"><span>DT</span></div>
                                        <div class="media-body">
                                            <span class="name">Designer Team</span>
                                            <span class="message">offline</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-azura"><span>SG</span></div>
                                        <div class="media-body">
                                            <span class="name">Sale Groups</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-orange"><span>NF</span></div>
                                        <div class="media-body">
                                            <span class="name">New Fresher</span>
                                            <span class="message">online</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <div class="avtar-pic w35 bg-indigo"><span>PL</span></div>
                                        <div class="media-body">
                                            <span class="name">Project Lead</span>
                                            <span class="message">offline since May 12</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- sidebar --}}
        @include('adminLayout.components.sidebar')

        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-12">
                            <h2>Stater Page</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Oculux</a></li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Stater Page</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    {{-- ContentPage --}}
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    <!-- Javascript -->
    @section('libScript')

    @show
    <script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
    @section('script')
        
    @show
</body>

</html>
