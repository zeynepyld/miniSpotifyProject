@extends('admin.layout')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Admin Dashboard
            </h1>
        </div>

        <div class="row">

            <!-- Albums -->
            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-left-primary shadow h-100 py-2">

                    <div class="card-body">

                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">

                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Albums
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \App\Models\Album::count() }}
                                </div>

                            </div>

                            <div class="col-auto">
                                <i class="fas fa-compact-disc fa-2x text-gray-300"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Artists -->

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-left-success shadow h-100 py-2">

                    <div class="card-body">

                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">

                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Artists
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ DB::table('artist')->count() }}
                                </div>

                            </div>

                            <div class="col-auto">
                                <i class="fas fa-microphone fa-2x text-gray-300"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Users -->

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-left-info shadow h-100 py-2">

                    <div class="card-body">

                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">

                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Users
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \App\Models\User::count() }}
                                </div>

                            </div>

                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Orders -->

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-left-warning shadow h-100 py-2">

                    <div class="card-body">

                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">

                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Orders
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \App\Models\Order::count() }}
                                </div>

                            </div>

                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Quick Menu -->

        <div class="card shadow mb-4">

            <div class="card-header">

                <h6 class="m-0 font-weight-bold text-primary">
                    Quick Actions
                </h6>

            </div>

            <div class="card-body">

                <a href="{{ route('admin.albums.create') }}"
                   class="btn btn-primary mr-2 mb-2">
                    <i class="fas fa-plus"></i>
                    New Album
                </a>

                <a href="{{ route('admin.artists.create') }}"
                   class="btn btn-success mr-2 mb-2">
                    <i class="fas fa-user-plus"></i>
                    New Artist
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="btn btn-warning mr-2 mb-2">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>

                <a href="{{ route('admin.reviews.index') }}"
                   class="btn btn-info mb-2">
                    <i class="fas fa-comments"></i>
                    Reviews
                </a>

            </div>

        </div>

    </div>

@endsection
