@extends('layouts.header')

@section('content')
    <h1>Edit Product</h1>

    @if($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required></div>
        <div class="mb-3"><label>Price</label><input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required></div>
        <div class="mb-3"><label>Stock</label><input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}"></div>
        <div class="mb-3"><label>Category</label><input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}"></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea></div>

        <div class="mb-3">
            <label>Image</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width:150px;">
            @endif
            <input type="file" name="image" class="form-control mt-2">
        </div>

        <button class="btn btn-primary">Update Product</button>
    </form>
@endsection
