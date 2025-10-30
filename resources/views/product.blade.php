@extends('layouts.header')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset($product->image) }}" class="img-fluid rounded shadow-sm" style="height:400px; width:100%; object-fit:cover;"/>
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

            <!-- Static Star Rating -->
            <div class="mb-3">
                <strong>Rating:</strong>
                <span class="ms-2">
                    <span class="star-gold">★</span>
                    <span class="star-gold">★</span>
                    <span class="star-gold">★</span>
                    <span class="star-gold">★</span>
                    <span class="star-gray">★</span>
                    <span class="ms-2 text-muted">(4.0/5)</span>
                </span>
            </div>

            <div class="mt-4">
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-lg">🛒 Add to Cart</a>
                <a href="{{ route('shop') }}" class="btn btn-secondary btn-lg ms-2">← Back to Shop</a>
            </div>
        </div>
    </div>
</div>

<!-- Star Rating Styles -->
<style>
.star-gold {
    color: #ffd700;
    font-size: 20px;
}

.star-gray {
    color: #ddd;
    font-size: 20px;
}
</style>
@endsection