@extends('layouts.header')

@section('content')
    <h1>Edit Product</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required
                autocomplete="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" step="0.01" name="price" class="form-control"
                value="{{ old('price', $product->price) }}" required autocomplete="transaction-amount">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}"
                autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="categorySelect" class="form-label">Category</label>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="addNewCategory" onclick="toggleCategoryInput()">
                <label class="form-check-label" for="addNewCategory">
                    Add New Category
                </label>
            </div>
            <select name="category" id="categorySelect" class="form-control" required aria-label="Select Category">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="new_category" id="newCategoryInput" class="form-control mt-2"
                placeholder="Enter new category name" style="display: none;" autocomplete="off"
                aria-label="New Category Name">
        </div>

        <script>
            function toggleCategoryInput() {
                const checkbox = document.getElementById('addNewCategory');
                const select = document.getElementById('categorySelect');
                const input = document.getElementById('newCategoryInput');

                if (checkbox.checked) {
                    select.style.display = 'none';
                    select.removeAttribute('required');
                    select.value = ''; // Clear dropdown value
                    input.style.display = 'block';
                    input.setAttribute('required', 'required');
                } else {
                    select.style.display = 'block';
                    select.setAttribute('required', 'required');
                    input.style.display = 'none';
                    input.removeAttribute('required');
                    input.value = ''; // Clear input value
                }
            }
        </script>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"
                autocomplete="off">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Rating input field (0-5 scale) --}}
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (0-5)</label>
            <input type="number" id="rating" step="0.1" min="0" max="5" name="rating" class="form-control"
                value="{{ old('rating', $product->rating ?? 0) }}" placeholder="Enter rating (e.g., 4.5)"
                autocomplete="off">
            <small class="text-muted">Enter a rating between 0 and 5</small>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width:150px;" class="mb-2"
                    id="currentImage">
            @endif
            <input type="file" id="image" name="image" class="form-control mt-2" aria-label="Product Image"
                accept="image/*">

            <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                <label class="form-label">New Image Preview:</label>
                <img id="imagePreview" src="#" alt="Image Preview"
                    style="max-width: 200px; height: auto; border-radius: 10px; border: 1px solid #ddd; padding: 5px;">
            </div>
            <div id="imageError" class="text-danger mt-2" style="display: none;"></div>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>

    <script>
        // Image Preview and Validation Script
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('imagePreview');
            const errorContainer = document.getElementById('imageError');
            const currentImage = document.getElementById('currentImage');

            // Reset state
            previewContainer.style.display = 'none';
            errorContainer.style.display = 'none';
            errorContainer.textContent = '';

            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    errorContainer.textContent = 'Invalid file type. Please upload a JPEG or PNG image.';
                    errorContainer.style.display = 'block';
                    this.value = ''; // Clear input
                    return;
                }

                // Validate file size (2MB max)
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    errorContainer.textContent = 'File size too large. Maximum size is 2MB.';
                    errorContainer.style.display = 'block';
                    this.value = ''; // Clear input
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';

                    // Optional: Hide current image if a new one is selected? 
                    // Usually better to keep it visible or maybe imply it's being replaced. 
                    // Let's just show the new one below it.
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection