@extends('layouts.app')

@section('content')
    <h1>All Products</h1>

            @foreach ($products as $product)
                <div>
                    <p>            
                        <a href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">
                            {{ $product->name }}
                        </a>
                    </p>
                    <p>{{ $product->stock }}</p>    
                    <p>${{ $product->price }}</p>
                    <p>
                        @foreach ($product->categories as $category)
                            {{ $category->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach

                        @auth
                        
                            <form action="{{ route('cart.addToCart', $product) }}" method="post">
                                @csrf
                                <button type="submit">Add to Cart</button>
                            </form>

                        @endauth

                        @if(session('success'))
                            <div style="color: green;">{{ session('success') }}</div>
                            <a href="{{ route('cart.viewCart')  }}">go to cart</a>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>        
            @endforeach

    {{ $products->links() }}

@endsection
