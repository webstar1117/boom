  <!-- header area started -->
  <header id="header-section">
      <div class="container-fluid">
          <nav class="navbar">
              <div class="bar">
                  <i class="fas fa-bars"></i>
              </div>
              <ul class="navbarNav">
                  <li class="nav-item active">
                      <a class="nav-link" href="javascript:;"> <span
                              class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;"></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;"></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;"></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;"></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;"></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;"></a>
                  </li>
                  <li class="nav-item">
                      @if (Auth::user())
                          <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span>
                                      Welcome,
                                  </span>
                                  <span>
                                      {{ Auth::user()->firstname }}
                                  </span>
                                  <i class="mdi mdi-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                  <a class="dropdown-item" href="{{ url('account') }}">My Account</a>
                                  <a class="dropdown-item" href="javascript:void();" id="topnav-layout"
                                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      <i class="bx bx-log-out-circle "></i>Sign Out
                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                      @csrf
                                  </form>
                              </div>
                          </div>

                      @else
                          <a class="nav-link sign-in-btn" href="{{ url('auth-login') }}">
                              SIGN IN
                          </a>
                      @endif
                  </li>
                  <li class="nav-item">
                      <iframe
                          src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fkifo.org%2F&layout=button&size=large&appId=1190383124805623&width=77&height=28"
                          width="77" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                          allowfullscreen="true"
                          allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                  </li>
              </ul>

          </nav>

          <!-- nav bar for small devices -->
          <nav class="navbar-sm">
              <div class="sign-in-area row">
                  <div class="col-3">
                      <a href="">
                          <div class="sign-in-icon-wrapper">
                              @if (Auth::check())
                                  <i class="fas fa-user-circle"></i>
                              @else
                                  <i class="fas fa-right-from-bracket"></i>
                              @endif
                          </div>
                      </a>
                  </div>
                  <div class="col-9 sign-in-text-wrapper">
                      @if (Auth::check())
                          <a href="{{ url('/') }}">
                              <p>{{ Auth::user()->firstname }}&nbsp;{{ Auth::user()->lastname }}</p>
                              <p>{{ Auth::user()->email }}</p>
                          </a>
                      @else
                          <a href="{{ url('auth-login') }}">
                              <p>Sign in</p>
                          </a>
                      @endif
                  </div>
              </div>
              @if (Auth::check())
                  <li>
                      <a href="javascript:void();"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                              class="fas fa-right-from-bracket"></i>
                          Sign Out
                      </a>
                  </li>
              @endif
              </ul>

          </nav>
      </div>
  </header>
