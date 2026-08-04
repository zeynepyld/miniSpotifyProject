@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Albums & Prices</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Available Music Albums</h6>
                </div>
                <div class="card-body">
                    <p class="mb-4">Here you can browse all available albums and check their prices.</p>

                    <!-- Albüm Listesi Tablosu Örneği -->
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Album Title</th>
                                <th>Artist</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Greatest Hits</td>
                                <td>Sample Artist</td>
                                <td>$19.99</td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm">
                                        <i class="fas fa-shopping-cart"></i> Buy Now
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
