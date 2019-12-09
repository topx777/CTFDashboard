<nav class="navbar top-navbar">
    <div class="container-fluid">

        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="{{ route('judge.home') }}"><img src="{{asset('images/icon.svg')}}" alt="CTFDashboard" class="img-fluid logo"></a>
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
            <ul class="nav navbar-nav">
                {{-- <li class="p_blog"><a href="page-blog.html" class="blog icon-menu" title="Blog">Blog</a></li> --}}
            </ul>
        </div>

        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="javascript:void()"
                        class="icon-menu">
                        {{ auth()->user()->username }}
                        </a>

                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                        class="icon-menu"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="icon-power"></i>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</nav>
