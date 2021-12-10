<header id="page-topbar" style="background:transparent;box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 0%);">
    <div class="navbar-header d-flex justify-content-between">
        <!-- LOGO -->
        <div>
            <a href="{{url('/')}}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('/assets/images/logo-light.png')}}" alt="" height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('/assets/images/logo-light.png')}}" alt="" height="50">

                </span>
            </a>

            <a href="index" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{asset('/assets/images/logo-light.svg')}}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('/assets/images/logo-light.png')}}" alt="" height="19">
                </span>
            </a>
        </div>
        <div>
            @if(Auth::user())
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                        Welcome,
                    </span>
                    <span>
                        {{Auth::user()->firstname}}
                    </span>
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                    <a class="dropdown-item" href="{{url('account')}}">My Account</a>
                    <a class="dropdown-item" href="javascript:void();" id="topnav-layout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-log-out-circle "></i>Sign Out
                    </a>
                </div>
            </div>

            @else
            <a class="nav-link dropdown-toggle arrow-none" style="color:white" href="{{url('auth-login')}}">
                <i class="bx bx-log-in"></i>LOG IN
            </a>
            @endif
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>