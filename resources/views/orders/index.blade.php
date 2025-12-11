@extends('layouts.header')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">📦 My Orders</h2>

        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="fw-bold">${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#order-details-{{ $order->id }}">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                            <tr class="collapse" id="order-details-{{ $order->id }}">
                                <td colspan="5">
                                    <div class="card card-body bg-light border-0">
                                        <h6 class="fw-bold">Items:</h6>
                                        <ul class="list-group list-group-flush mb-2">
                                            @foreach($order->items as $item)
                                                <li
                                                    class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                                                    <span>{{ $item->product_name }} <small class="text-muted">x
                                                            {{ $item->quantity }}</small></span>
                                                    <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted"><strong>Shipping to:</strong> {{ $order->address }}</small>
                                            <small class="text-muted"><strong>Phone:</strong> {{ $order->phone }}</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-shopping-bag fa-3x text-muted"></i>
                </div>
                <h4>No orders found</h4>
                <p class="text-muted">You haven't placed any orders yet.</p>
                <a href="{{ route('shop') }}" class="btn btn-dark mt-3">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection