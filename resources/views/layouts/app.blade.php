<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed layout-wide"
    dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IMAYWEB - Agence Web Digitale à Marrakech Maroc</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/image/icone_logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/img/image/icone_logo.png') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-footer1 {
            padding: 0.25rem 1.5rem 1.5rem;
        }
    </style>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <span class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/image/logo-imayweb.svg') }}" height="110" width="195"
                            class="me-2 rounded-circle" alt="logoImayweb" />
                    </span>
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Apps -->

                    @unless(auth()->user()->hasRole('comptable'))
                    <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-dashboard'></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Clients</span></li>
                    <li class="menu-item {{ request()->is('clients*') ? 'active' : '' }}" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>Clients</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('clients.index') }}" class="menu-link">
                                    <div>Tous les clients</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('clients.create') }}" class="menu-link">
                                    <div>Ajouter client</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endunless

                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Facturation</span></li>
                    @unless(auth()->user()->hasRole('comptable'))

                    <li class="menu-item {{ request()->is('devis*') ? 'active' : '' }}" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-notepad"></i>
                            <div>Devis</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('devis.index') }}" class="menu-link">
                                    <div>Tous les Devis</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('devis.create') }}" class="menu-link">
                                    <div>Ajouter Devis</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endunless
                    <li class="menu-item {{ request()->is('factures*') ? 'active' : '' }}" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                            <div>Factures</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('factures.index') }}" class="menu-link">
                                    <div>Toutes les factures</div>
                                </a>
                            </li>
                            @unless(auth()->user()->hasRole('comptable'))
                            <li class="menu-item">
                                <a href="{{ route('factures.create') }}" class="menu-link">
                                    <div>Ajouter Facture</div>
                                </a>
                            </li>
                            @endunless
                        </ul>
                    </li>
                    <li class="menu-item {{ request()->is('paiments*') ? 'active' : '' }}">
                        <a href="{{ route('paiments.index') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-credit-card'></i>
                            <div>Règlements</div>
                        </a>
                    </li>
                    @unless(auth()->user()->hasRole('admin') || auth()->user()->hasRole('comptable'))
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Réglages</span></li>
                    <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-user-account'></i>
                            <div>Utilisateurs</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('entreprises*') ? 'active' : '' }}">
                        <a href="{{ route('entreprises.index') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-business'></i>
                            <div>Entreprises</div>
                        </a>
                    </li>
                    @endunless
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ (Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('/assets/img/image/admin1.png') }}"
                                            alt="Admin Image" class="w-px-40 h-auto rounded-circle">

                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ (Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('/assets/img/image/admin1.png') }}"
                                                            alt="Admin Image" class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                                    <small class="text-muted"> {{
                                                        Auth::user()->roles->pluck('name')->implode(', ') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                            <i class='bx bxs-user me-2'></i>
                                            <span class="align-middle">Mon profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class='bx bxs-lock me-2'></i>
                                            <span class="align-middle">Mot de passe</span>
                                        </a>
                                    </li>

                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <!-- Layout Demo -->
                        @yield('content')
                        <!--/ Layout Demo -->
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                IMAYWEB. All Rights Reserved.
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
        </div>
        <!--  alert -->
        <div id="myAlert"
            class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 start-50 translate-middle-x @if(session('success')) show @endif"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class='bx bxs-badge-check'></i>
                <div class="me-auto fw-medium" style="margin-left: 8px">Success</div>
            </div>
            <div class="toast-body" style="text-align: center">
                @if(session('success'))
                {{ session('success') }} !&nbsp; 🚀
                @endif
            </div>
        </div>
        <!--  alert -->
        <div id="myAlert"
            class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x @if(session('error')) show @endif"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class='bx bxs-badge-check'></i>
                <div class="me-auto fw-medium" style="margin-left: 8px">Error</div>
            </div>
            <div class="toast-body" style="text-align: center">
                @if(session('error'))
                {{ session('error') }} !&nbsp; 🚀
                @endif
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                // Check if the alert should be shown
                var myAlert = document.getElementById('myAlert');
                var myAlert2 = document.getElementById('myAlert2');
        
                if (myAlert.classList.contains('show')) {
                    // Hide the alert after 2000 milliseconds (2 seconds)
                    setTimeout(function () {
                        myAlert.classList.remove('show');
                    }, 2000);
                }
                if (myAlert2.classList.contains('show')) {
                    // Hide the alert after 2000 milliseconds (2 seconds)
                    setTimeout(function () {
                        myAlert.classList.remove('show');
                    }, 2000);
                }
            });
    </script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>