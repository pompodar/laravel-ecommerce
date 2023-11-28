@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label for="description">Description:</label>
        <textarea name="description" required>{{ $product->description }}</textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" value="{{ $product->price }}" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ $product->stock }}" required>

        <label for="categories">Categories:</label>
        <select name="categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="attributes">Attributes:</label>
        <select name="attributes[]" multiple>
            @foreach ($attributes as $attribute)
                <option value="{{ $attribute->id }}" {{ in_array($attribute->id, $selectedAttributes) ? 'selected' : '' }}>
                    {{ $attribute->name }}
                </option>
            @endforeach
        </select>

        <label for="photo">Photo:</label>
        <input type="file" name="photo">

        <!-- Add fields for multiple attributes if needed -->

        <button type="submit">Update Product</button>
    </form>
@endsection
