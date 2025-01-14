<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }} " />

    @stack('styles')

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="light">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="light">
                    <a class="logo d-flex align-items-center" style="text-decoration: none;">
                        <img src="{{ asset('img/logo.png') }}" alt="navbar brand" class="navbar-brand" height="40" />
                        {{-- <img src="{{ asset('img/ep.png') }}" alt="navbar brand" class="navbar-brand" height="20" /> --}}
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content h-100 d-flex flex-column">
                    <ul class="nav nav-secondary flex-grow-1">
                        <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Route::is('project-id') ? 'active' : '' }}{{ Route::is('data-client') ? 'active' : '' }} {{ Route::is('data-vendor') ? 'active' : '' }} {{ Route::is('bank') ? 'active' : '' }} {{ Route::is('pt') ? 'show' : '' }}">
                            <a data-bs-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Master</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Route::is('project-id') ? 'show' : '' }}{{ Route::is('data-client') ? 'show' : '' }} {{ Route::is('data-vendor') ? 'show' : '' }} {{ Route::is('bank') ? 'show' : '' }} {{ Route::is('pt') ? 'show' : '' }}"
                                id="base">
                                <ul class="nav nav-collapse">
                                    <li class="{{ Route::is('project-id') ? 'active' : '' }}">
                                        <a href="{{ route('project-id') }}">
                                            <span class="sub-item">Data Project ID</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('data-client') ? 'active' : '' }}">
                                        <a href="{{ route('data-client') }}">
                                            <span class="sub-item">Data Client</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('data-vendor') ? 'active' : '' }}">
                                        <a href="{{ route('data-vendor') }}">
                                            <span class="sub-item">Data Vendor</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('bank') ? 'active' : '' }}">
                                        <a href="{{ route('bank') }}">
                                            <span class="sub-item">Data Bank</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('pt') ? 'active' : '' }}">
                                        <a href="{{ route('pt') }}">
                                            <span class="sub-item">Data PT</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ Route::is('invoice') ? 'active' : '' }}">
                            <a href="{{ route('invoice') }}" class="collapsed">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('bast') ? 'active' : '' }}">
                            <a href="{{ route('bast') }}" class="collapsed">
                                <i class="fas fa-table"></i>
                                <p>BAST</p>
                            </a>
                        </li>

                        <li class="nav-item {{ Route::is('po') ? 'active' : '' }}">
                            <a href="{{ route('po') }}" class="collapsed">
                                <i class="far fa-chart-bar"></i>
                                <p>Purchase Order</p>
                                {{-- <span class="caret"></span> --}}
                            </a>
                        <li class="nav-item
                            {{ Route::is('data-sph') ? 'active' : '' }}">
                            <a href="{{ route('data-sph') }}">
                                <i class="fas fa-desktop"></i>
                                <p>SPH</p>
                                {{-- <span class="badge badge-success">4</span> --}}
                            </a>
                        </li>

                    </ul>
                    <div class="sidebar-footer mt-auto">
                        <ul class="nav nav-secondary flex-grow-1">
                            <li class="nav-item {{ Route::is('logout') ? 'active' : '' }}">
                                <a href="{{ route('logout') }}" class="collapsed" id="logoutBtn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" >
                        <a class="logo d-flex align-items-center" style="text-decoration: none;">
                            <img src="{{ asset('img/logo.png') }}" alt="navbar brand" class="navbar-brand"
                                height="20" />
                            <h5 style="margin-left: 8px; color: white;">MPA-Group</h5>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" 
                                    aria-expanded="false">
                                    {{-- <div class="avatar-sm">
                                        <img src="assets/img/" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div> --}}
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Admin</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class=" container p-4 ">

                @yield('content')
            </div>
            <footer class="footer">
                </ul>
                </nav>
                <div class="copyright">
                    2025, made with <i class="fa fa-heart heart text-danger"></i> by
                    <a>Mahasiswa Magang Polije</a>
                </div>
        </div>
        </footer>
    </div>

    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    @stack('scripts')
    <!-- Select2! -->
    <script src="{{ asset('select2/select2.js') }}"></script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>
