@extends('layouts.app')

@section('content')
    <h1>All Products</h1>
    <a href="{{ route('admin.products.create') }}">add a product</a>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Categories</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>            
                        <a href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">
                            {{ $product->name }}
                        </a></td>
                    <td>{{ $product->stock }}</td>    
                    <td>${{ $product->price }}</td>
                    <td>
                        @foreach ($product->categories as $category)
                            {{ $category->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

@endsection
