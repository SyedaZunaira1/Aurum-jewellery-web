@extends('layouts.header')

@section('content')
    <h1 class="text-center mb-5">💎 Featured Jewellery 💎</h1>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;"/>
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top"/>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-primary fw-bold">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-dark btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No featured products found.</p>
        @endforelse
    </div>
@endsection
