<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MusicStore - Panel</title>

    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Logo / Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           href="{{ auth()->user()->is_admin ? route('admin.artists.index') : url('/user') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-music"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MusicStore</div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- ADMIN MENU -->
        @if(auth()->check() && auth()->user()->is_admin)

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.artists.index') }}">
                    <i class="fas fa-fw fa-music"></i>
                    <span>Artists</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Management
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.albums.index') }}">
                    <i class="fas fa-fw fa-compact-disc"></i>
                    <span>Albums</span>
                </a>
            </li>

        @else

            <!-- USER MENU -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.albums') }}">
                    <i class="fas fa-fw fa-compact-disc"></i>
                    <span>Albums & Prices</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.favorites') }}">
                    <i class="fas fa-fw fa-heart"></i>
                    <span>Favorites</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.orders') }}">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Orders & Receipts</span>
                </a>
            </li>

        @endif

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown no-arrow">

                        <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">
                            {{ auth()->user()->name }}
                            ({{ auth()->user()->is_admin ? 'Admin' : 'Regular User' }})
                        </span>

                    </li>

                </ul>

            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; MusicStore 2026</span>
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
