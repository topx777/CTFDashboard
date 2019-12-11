<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{ route('judge.home') }}"><img src="{{asset('images/icon.svg')}}" alt="CTF Upds"
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
                <span>Bienvenido</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong> {{auth()->user()->username}} </strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
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
                <li class="{{( Route::currentRouteName() =='competitions.register') ? 'active open':''}}"><a href="{{ route('competitions.register') }}"><i class="fa fa-plus"></i><span>Crear Competencia</span></a></li>
                <li class="{{( (explode('.', Route::currentRouteName())[0] =='competitions') || (app('request')->has('competition'))) ? 'active open':''}}">
                    <a href="#" class="has-arrow"><i class="icon-trophy"></i><span>Mis Competencias</span></a>
                    <ul>
                        @foreach (auth()->user()->Judge->Competitions as $competency)
                        <li class="{{ (\App\Competition::getRouteID(app('request')->input('competition')) == $competency->id) ? 'active open' : '' }}">
                            <a href="#" class="has-arrow"><span>{{ $competency->name }}</span></a>
                            <ul>
                                <li><a style="padding: 4px 10px 4px 45px;" href="{{ route('competitions.options', ["competition" => encrypt($competency->id)]) }}"><i class="fa fa-cogs"></i><span>Opciones</span></a></li>
                                <li><a style="padding: 4px 10px 4px 45px;" href="{{ route('teams.list', ["competition" => encrypt($competency->id)]) }}"><i class="icon-users"></i><span>Equipos</span></a></li>
                                <li><a style="padding: 4px 10px 4px 45px;" href="{{ route('levels.list', ["competition" => encrypt($competency->id)]) }}"><i class="icon-puzzle"></i><span>Niveles</span></a></li>
                                <li><a style="padding: 4px 10px 4px 45px;" href="{{ route('competitionChallenge.list', ["competition" => encrypt($competency->id)]) }}"><i class="icon-flag"></i><span>Retos</span></a></li>
                                <li><a style="padding: 4px 10px 4px 45px;" href="#"><i class="fa fa-list-ol"></i><span>Posiciones</span></a></li>
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="header">Menu</li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='categories')?'active open':''}}"><a href="{{ route('categories.list') }}"><i class="icon-layers"></i><span>Categorias</span></a></li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='challenges')?'active open':''}}"><a href="{{ route('challenges.list') }}"><i class="icon-flag"></i><span>Retos Generales</span></a></li>
                <li class="{{( explode('.', Route::currentRouteName())[0] =='files')?'active open':''}}" ><a href="{{ route('files.list') }}"><i class="icon-grid"></i><span>FileManager</span></a></li>
            </ul>
        </nav>
    </div>
</div>
