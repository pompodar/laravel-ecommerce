@extends('layouts.app') {{-- You can adjust the layout based on your application's structure --}}

@section('content')
    <h1>All Products</h1>


    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: {{ $product->price }}</p>
    <p>Stock: {{ $product->stock }}</p>

            <!-- Edit Button -->
            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>

            <!-- Delete Button -->
            <form method="post" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
@endsection