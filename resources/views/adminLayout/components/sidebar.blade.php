<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="#"><img src="{{asset('images/icon.svg')}}" alt="Oculux Logo"
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
                <span>Bienvenido,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong> {{auth()->user()->username}} </strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="{{ route('options') }}"><i class="icon-settings"></i>Opciones</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                        class="icon-menu"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form2').submit();">
                        <i class="icon-power"></i>
                        Logout
                        </a>
                    </li>
                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="header">Menu</li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='judges')?'active open':''}}">
                    <a href="{{route('judges.list')}}"><i class="icon-user"></i><span>Jueces</span></a>
                    <ul>
                        <li class="{{(Route::currentRouteName()=='judges.register')?'active':''}}"><a href="{{route('judges.register')}}">Registro</a></li>
                        <li class="{{(Route::currentRouteName()=='judges.list')?'active':''}}"><a href="{{route('judges.list')}}">Lista</a></li>
                    </ul>
                </li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='competitions')?'active open':''}}">
                    <a href="{{route('competitions.list')}}"><i class="icon-user"></i><span>Competencias</span></a>
                    <ul>
                        <li class="{{(Route::currentRouteName()=='competitions.list')?'active':''}}"><a href="{{route('competitions.list')}}">Lista</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
