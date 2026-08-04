@extends('admin.layout')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Orders & Receipts</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-success text-white">
                        <h6 class="m-0 font-weight-bold">Order History</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Here you can view your past orders and download your receipts.</p>

                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Album Title</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                    <th>Receipt</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#ORD-2026-001</td>
                                    <td>Greatest Hits</td>
                                    <td>$19.99</td>
                                    <td>2026-08-03</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm">
                                            <i class="fas fa-download"></i> Download PDF
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
