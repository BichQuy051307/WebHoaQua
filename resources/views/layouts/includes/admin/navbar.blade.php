<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div
            class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100"
        >
            <a class="navbar-brand brand-logo" href="/admin/dashboard"
                ><img
                    src="{{ asset('admin/assets/images/logo.png') }}"
                    alt="logo"
            /></a>
            <a class="navbar-brand brand-logo-mini" href="/admin/dashboard"
                ><img
                    src="{{ asset('admin/assets/images/logo-mini.svg') }}"
                    alt="logo"
            /></a>
            <button
                class="navbar-toggler navbar-toggler align-self-center"
                type="button"
                data-toggle="minimize"
            >
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div
        class="navbar-menu-wrapper d-flex align-items-center justify-content-end"
    >
        <ul class="navbar-nav mr-lg-4 w-100">
            
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
            <li class="nav-item nav-profile dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    data-bs-toggle="dropdown"
                    id="profileDropdown"
                >
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->avatar)
                    <img
                        style="width: 40px; height: 40px; border-radius: 100%"
                        src="{{Auth::guard('admin')->user()->avatar}}"
                    />
                    @else
                    <img
                        style="width: 40px; height: 40px; border-radius: 100%"
                        src="https://s3-us-west-1.amazonaws.com/s3-lc-upload/assets/default_avatar.jpg"
                    />
                    @endif

                    @if(Auth::guard('admin')->check())
                    <span
                        class="nav-profile-name"
                        >{{Auth::guard('admin')->user()->name}}</span
                    >
                    @endif
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right navbar-dropdown"
                    aria-labelledby="profileDropdown"
                >
                    <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Cài đặt
                    </a>
                    <a class="dropdown-item" href="/admin/logout">
                        <i class="mdi mdi-logout text-primary"></i>
                        {{ __("Đăng xuất") }}
                    </a>
                </div>
            </li>
        </ul>
        <button
            class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button"
            data-toggle="offcanvas"
        >
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
