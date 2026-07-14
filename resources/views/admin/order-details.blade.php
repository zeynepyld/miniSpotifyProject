@extends('admin.layout')
@section('content')
    <h4>Order Items</h4>
    <table class="table">
        <thead>
        <tr>
            <th>Album</th>
            <th>Quantity</th>
            <th>Unit Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->album_title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->unit_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
@endsection
