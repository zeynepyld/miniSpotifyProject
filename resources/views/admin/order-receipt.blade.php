@extends('admin.layout')

@section('content')

    <div class="container mt-4">

        <div class="card shadow p-4">

            <h2 class="text-success">
                ✔ Order Successfully Created
            </h2>

            <hr>

            <h4>
                Order #{{ $order->id }}
            </h4>

            <hr>

            @foreach($items as $item)

                <h5>
                    Album:
                    {{ $item->album_title }}
                </h5>

                <p>
                    Quantity:
                    {{ $item->quantity }}
                </p>

                <p>
                    Unit Price:
                    {{ $item->unit_price }} ₺
                </p>

                <hr>

            @endforeach


            <h3>
                TOTAL:
                {{ $order->total_price }} ₺
            </h3>

            <h5>
                Status:
                {{ ucfirst($order->status) }}
            </h5>

        </div>

    </div>

@endsection
