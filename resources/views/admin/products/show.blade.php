@extends('layouts.app') {{-- You can adjust the layout based on your application's structure --}}

@section('content')

    <h1>{{ $product->name }}</h1>
    <p>Description: {{ $product->description }}</p>
    <p>Price: {{ $product->price }}</p>
    <p>Stock: {{ $product->stock }}</p>

    <h2>Variations:</h2>
    @foreach ($product->variations as $variation)
        <p>Price: ${{ $variation->price }}</p>
        <!-- Add other variation details as needed -->

         @if ($variation->attributeValues->isNotEmpty())
            <ul>
                @foreach ($variation->attributeValues as $attribute)
                    <li>{{ $attribute->attribute->name }}: {{ $attribute->value }}</li>
                @endforeach
            </ul>
        @endif
    @endforeach

            <!-- Edit Button -->
            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>

            <!-- Delete Button -->
            <form method="post" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
@endsection