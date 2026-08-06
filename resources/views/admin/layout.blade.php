<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MusicStore - Panel</title>

    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Logo -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           href="{{ auth()->user()->is_admin ? route('admin.artists.index') : route('user.dashboard') }}">

            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-music"></i>
            </div>

            <div class="sidebar-brand-text mx-3">
                MusicStore
            </div>

        </a>

        <hr class="sidebar-divider my-0">

        @if(auth()->user()->is_admin)

            <!-- ADMIN -->

            <li class="nav-item {{ request()->routeIs('admin.artists*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.artists.index') }}">
                    <i class="fas fa-fw fa-music"></i>
                    <span>Artists</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Management
            </div>

            <li class="nav-item {{ request()->routeIs('admin.albums*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.albums.index') }}">
                    <i class="fas fa-fw fa-compact-disc"></i>
                    <span>Albums</span>
                </a>
            </li>

        @else

            <!-- USER -->

            <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Music
            </div>

            <li class="nav-item {{ request()->routeIs('user.albums*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.albums') }}">
                    <i class="fas fa-fw fa-compact-disc"></i>
                    <span>Albums</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('user.favorites*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.favorites') }}">
                    <i class="fas fa-fw fa-heart"></i>
                    <span>Favorites</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Purchases
            </div>

            <li class="nav-item {{ request()->routeIs('user.orders*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.orders') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Orders & Receipts</span>
                </a>
            </li>

        @endif

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item d-flex align-items-center">

                        <span class="mr-3 font-weight-bold text-gray-700">
                            {{ auth()->user()->name }}
                            ({{ auth()->user()->is_admin ? 'Admin' : 'User' }})
                        </span>

                    </li>

                    <li class="nav-item">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>

                        </form>

                    </li>

                </ul>

            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="text-center my-auto">
                    <span>Copyright © MusicStore 2026</span>
                </div>
            </div>
        </footer>

    </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
