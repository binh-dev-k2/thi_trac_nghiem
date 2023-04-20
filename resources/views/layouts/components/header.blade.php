<header class="header-top">
    <nav class="navbar navbar-light">
      <div class="navbar-left">
        <div class="logo-area">
          <a class="navbar-brand" href="{{ route('home') }}">
            <img class="dark" src="{{asset('assets/img/logo-dark.png')}}" alt="logo">
            <img class="light" src="{{asset('assets/img/logo-dark.png')}}" alt="logo">
          </a>
          <a href="#" class="sidebar-toggle">
            <img class="svg" src="{{asset('assets/img/svg/align-center-alt.svg')}}" alt="img"></a>
        </div>
      </div>

      <div class="navbar-right">
        <ul class="navbar-right__menu">
          

         
          <li class="nav-author">
            <div class="dropdown-custom">
              <a href="javascript:;" class="nav-item-toggle">
                <span class="nav-item__title">{{ Auth::user()->name }}<i class="las la-angle-down nav-item__arrow"></i></span>
              </a>
              <div class="dropdown-parent-wrapper">
                <div class="dropdown-wrapper">
                  <div class="nav-author__info">
                    <div>
                      <h6>{{ Auth::user()->name }}</h6>
                      <span>{{ Auth::user()->role == 1? "Giáo viên" : "Sinh viên" }}</span>
                    </div>
                  </div>
                  <div class="nav-author__options">
                    <ul>
                      <li>
                        <a href="#">
                          <i class="uil uil-user"></i> Thông tin tài khoản</a>
                      </li>
                    </ul>
                    <a href="{{ route('logout') }}" class="nav-author__signout"
                  onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"> <i class="uil uil-sign-out-alt"></i> Đăng xuất</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
                  </div>
                  
                </div>

              </div>
            </div>
          </li>

        </ul>

        <div class="navbar-right__mobileAction d-md-none">
          <a href="#" class="btn-search">
            <img src="{{asset('assets/img/svg/search.svg')}}" alt="search" class="svg feather-search">
            <img src="{{asset('assets/img/svg/x.svg')}}" alt="x" class="svg feather-x"></a>
          <a href="#" class="btn-author-action">
            <img class="svg" src="{{asset('assets/img/svg/more-vertical.svg')}}" alt="more-vertical"></a>
        </div>
      </div>

    </nav>
  </header>