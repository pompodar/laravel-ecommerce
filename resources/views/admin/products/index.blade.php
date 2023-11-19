@extends('layouts.app') {{-- You can adjust the layout based on your application's structure --}}

@section('content')
    <h1>All Products</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($products as $product)
        <div>
            <a href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">
                    <h2>{{ $product->name }}</h2>    
            </a>
            <p>{{ $product->description }}</p>

            <p><strong>Categories:</strong>
                @foreach ($product->categories as $category)
                    {{ $category->name }}
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>

            
            <p><strong>Attributes:</strong>
                @foreach ($product->attributes as $attribute)
                    {{ $attribute->name }}
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>

            <!-- Edit Button -->
            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>

            <!-- Delete Button -->
            <form method="post" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
        </div>
    @endforeach
@endsection
