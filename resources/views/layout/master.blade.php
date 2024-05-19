<!DOCTYPE html>

<head>
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="header-tabs-enabled header-menu-enabled">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" class="header">
                    <div class="header-top d-flex align-items-stretch flex-grow-1 h-60px h-lg-100px"
                        data-kt-sticky="true" data-kt-sticky-name="header-topbar"
                        data-kt-sticky-offset="{default: '100px', lg: 'false'}"
                        data-kt-sticky-dependencies="#kt_wrapper"
                        data-kt-sticky-class="fixed-top bg-body shadow-sm border-0">
                        <div class="container-custom container-xxl d-flex w-100">
                            <div class="d-flex flex-stack align-items-stretch w-100">
                                <div class="d-flex align-items-center align-items-lg-stretch me-5">
                                    <button
                                        class="d-lg-none btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px ms-n3 me-2"
                                        id="kt_header_navs_toggle">
                                        <i class="ki-duotone ki-abstract-14 fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <a href="index.html" class="d-flex align-items-center">
                                        <img alt="Logo" src="assets/media/logos/logo.png"
                                            class="h-60px h-lg-80px" />
                                    </a>
                                </div>
                                <div class="topbar d-flex align-items-center flex-shrink-0">
                                    <div class="d-flex align-items-center ms-2" id="kt_header_user_menu_toggle">
                                        <div class="btn btn-icon btn-custom" data-kt-menu-trigger="click"
                                            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-user fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                            data-kt-menu="true">
                                            <div class="menu-item px-5">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <a href="{{ route('logout') }}" class="menu-link px-5"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Sign Out
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-bottom d-lg-flex flex-column align-items-stretch w-100">
                        <div class="container-custom container-xxl d-lg-flex flex-column w-100">
                            <div class="header-tabs d-flex align-items-stretch w-100 h-60px h-lg-100px overflow-auto mb-5 mb-lg-0"
                                id="kt_header_tabs">
                                <ul class="nav nav-stretch flex-nowrap w-100 h-100">
                                    <li class="nav-item flex-equal">
                                        <a class="nav-link d-flex flex-column text-nowrap flex-center w-100 {{ request()->routeIs('home') ? 'active' : '' }}"
                                            href="{{ route('home') }}">
                                            <span class="text-uppercase text-gray-900 fw-bold fs-6 fs-lg-5">My
                                                Account</span>
                                            <span class="text-gray-500 fs-8 fs-lg-7">All the transactions</span>
                                        </a>
                                    </li>
                                    <li class="nav-item flex-equal">
                                        <a class="nav-link d-flex flex-column text-nowrap flex-center w-100 {{ request()->routeIs('deposit') ? 'active' : '' }}"
                                            href="{{ route('deposit') }}">
                                            <span
                                                class="text-uppercase text-gray-900 fw-bold fs-6 fs-lg-5">Deposit</span>
                                            <span class="text-gray-500 fs-8 fs-lg-7">All the credits</span>
                                        </a>
                                    </li>
                                    <li class="nav-item flex-equal">
                                        <a class="nav-link d-flex flex-column text-nowrap flex-center w-100 {{ request()->routeIs('withdrawal') ? 'active' : '' }}"
                                            href="{{ route('withdrawal') }}">
                                            <span
                                                class="text-uppercase text-gray-900 fw-bold fs-6 fs-lg-5">Withdrawal</span>
                                            <span class="text-gray-500 fs-8 fs-lg-7">All the debits</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="kt_content_container" class="container-custom container-xxl d-flex flex-column-fluid">
                    <div class="content d-flex flex-row flex-row-fluid" id="kt_content">
                        <div class="d-flex flex-column flex-row-fluid">
                            <div class="flex-column-fluid">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-custom container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-gray-900 order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">{{ now()->year }}&copy;</span>
                            <a href="javascript:void(0);" target="_blank"
                                class="text-gray-800 text-hover-primary">Simple Banking</a>
                        </div>
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="javascript:void(0);" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    @yield('script')
</body>

</html>
