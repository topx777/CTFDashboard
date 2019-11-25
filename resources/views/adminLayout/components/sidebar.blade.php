<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="index.html"><img src="{{asset('images/icon.svg')}}" alt="Oculux Logo"
                class="img-fluid logo"><span>CTFUPDS</span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                class="lnr lnr-menu icon-close"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{asset('images/user.png')}}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Louis
                        Pierce</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="header">Menu</li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='users')?'active open':''}}"><a href="{{route('users.list')}}"><i class="icon-user"></i><span>Usuarios</span></a></li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='teams')?'active open':''}}"><a href="{{route('teams.list')}}"><i class="icon-users"></i><span>Equipos</span></a></li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='teams')?'active open':''}}"><a href="{{route('teams.list')}}"><i class="icon-users"></i><span>Retos</span></a></li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='levelsCategories.list')?'active open':''}}" ><a href="{{ route('levelsCategories.list') }}"><i class="icon-layers"></i><span>Niveles Categorias</span></a></li>
                <li><a href=""><i class="icon-badge"></i><span>Retos</span></a></li>
                </li>   
            </ul>
        </nav>
    </div>
</div>
   