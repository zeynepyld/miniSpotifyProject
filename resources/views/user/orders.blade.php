@extends('admin.layout')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Orders & Receipts</h1>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">Order History</h6>
            </div>

            <div class="card-body">

                @if($orders->count())

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                            <tr>
                                <th>Order ID</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Receipt</th>
                            </tr>

                            </thead>

                            <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    <td>#{{ $order->id }}</td>

                                    <td>{{ $order->total_price }} ₺</td>

                                    <td>

                                        @switch($order->status)

                                            @case(0)
                                                Pending
                                                @break

                                            @case(1)
                                                Preparing
                                                @break

                                            @case(2)
                                                Shipping
                                                @break

                                            @case(3)
                                                Completed
                                                @break

                                            @case(4)
                                                Cancelled
                                                @break

                                            @default
                                                Unknown

                                        @endswitch

                                    </td>

                                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>

                                    <td>

                                        <a href="{{ route('admin.orders.receipt',$order->id) }}"
                                           class="btn btn-info btn-sm">

                                            <i class="fas fa-file-invoice"></i>

                                            View Receipt

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="alert alert-warning">

                        You have not placed any orders yet.

                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
