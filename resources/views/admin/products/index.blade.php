@extends('layouts.header')

@section('content')
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-gold: #b8941e;
            --deep-navy: #1a1a2e;
            --navy-blue: #16213e;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border: none;
            color: white;
            font-weight: 600;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, var(--dark-gold), var(--primary-gold));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        .table-custom thead {
            background: var(--deep-navy);
            color: var(--primary-gold);
        }

        .badge-category {
            background-color: var(--navy-blue) !important;
            color: var(--primary-gold);
            border: 1px solid var(--primary-gold);
        }

        .page-title {
            color: var(--deep-navy);
            font-weight: 700;
            border-bottom: 3px solid var(--primary-gold);
            display: inline-block;
            padding-bottom: 5px;
        }
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">Admin - Products</h1>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-gold">
                <i class="fas fa-plus"></i> Add New Product
            </a>

            <div class="d-flex flex-wrap gap-3">
                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control border-secondary" placeholder="Search product..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                    @if(request('search'))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary" title="Clear Search">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex gap-2">
                    <!-- Preserve search if exists -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <select name="category" class="form-select border-secondary" style="width: 200px;">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark">Filter</button>
                    @if(request('category'))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </form>

                <!-- Delete Category Dropdown -->
                @if(request('category') && request('category') != '')
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-trash-alt"></i> Delete Category
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('admin.products.deleteCategory') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                    <input type="hidden" name="action" value="move">
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Are you sure? Products will be moved to \'Uncategorized\'.')">
                                        Keep Products (Move to Uncategorized)
                                    </button>
                                </form>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.products.deleteCategory') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="dropdown-item text-danger"
                                        onclick="return confirm('WARNING: Are you sure? All products in this category will be PERMANENTLY DELETED.')">
                                        Delete Category & All Products
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover table-custom mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->stock > 0)
                                        <span class="text-success fw-bold">{{ $product->stock }}</span>
                                    @else
                                        <span class="text-danger fw-bold">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-category">{{ $product->category }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this product?')"
                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection