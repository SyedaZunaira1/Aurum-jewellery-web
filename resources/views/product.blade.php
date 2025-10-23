@extends('layouts.header')

@section('content')
<div class="row">
    <div class="col-md-6">
        @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" style="height:400px; object-fit:cover;"/>
        @else
            <img src="https://via.placeholder.com/400x400?text=No+Image" alt="No Image" class="img-fluid rounded shadow-sm">
        @endif
    </div>

    <div class="col-md-6">
        <h2 class="fw-bold">{{ $product->name }}</h2>
        <p class="text-primary fw-bold fs-4">${{ number_format($product->price, 2) }}</p>
        <p>{{ $product->description ?: 'No description available.' }}</p>
        <p><strong>Category:</strong> {{ $product->category ?: 'N/A' }}</p>
        <p><strong>Stock:</strong> {{ $product->stock ?? 0 }}</p>

        <div class="mt-4">
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-outline-primary btn-lg">🛒 Add to Cart</a>
            <a href="{{ route('shop') }}" class="btn btn-secondary btn-lg ms-2">← Back to Shop</a>
        </div>
    </div>
</div>
@endsection
