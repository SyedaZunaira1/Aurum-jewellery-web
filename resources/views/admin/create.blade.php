@extends('layouts.header')

@section('content')
    <h1>Add New Product</h1>

    @if($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
        <div class="mb-3"><label>Price</label><input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required></div>
        <div class="mb-3"><label>Stock</label><input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}"></div>
        <div class="mb-3"><label>Category</label><input type="text" name="category" class="form-control" value="{{ old('category') }}"></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control">{{ old('description') }}</textarea></div>
        <div class="mb-3"><label>Image</label><input type="file" name="image" class="form-control"></div>
        <button class="btn btn-success">Add Product</button>
    </form>
@endsection
