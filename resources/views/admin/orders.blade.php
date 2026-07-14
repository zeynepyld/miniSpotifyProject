@extends('admin.layout')

@section('content')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Albums</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>

        @foreach($orders as $order)

            <tr>

                <td>
                    {{ $order->user->name ?? 'Guest' }}
                </td>

                <td>
                    {{ $order->order_date }}
                </td>

                <td>

                    @foreach($order->items as $item)

                        <div>
                            <strong>
                                {{ $item->album->title }}
                            </strong>
                            <br>

                            Quantity:
                            {{ $item->quantity }}

                            <br>

                            Unit Price:
                            {{ $item->unit_price }} ₺
                        </div>

                        <hr>

                    @endforeach

                </td>

                <td>
                    {{ $order->total_price }} ₺
                </td>

                <td>
                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                        @csrf

                        <select name="status">
                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Preparing</option>
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Shipped</option>
                            <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Completed</option>
                            <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Cancelled</option>
                        </select>
                            </option>

                        </select>

                    </form>
                </td>


                <td>

                    <a href="{{ route('admin.orders.details', $order->id) }}"
                       class="btn btn-info btn-sm">
                        Details
                    </a>


                    <form action="{{ route('admin.orders.delete', $order->id) }}"
                          method="POST"
                          style="display:inline;">

                        @csrf

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this order?')">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

@endsection
