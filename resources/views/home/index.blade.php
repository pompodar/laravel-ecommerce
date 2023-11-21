@extends('layouts.app')

@section('content')

    <h1>All Products</h1>

    <hr>

    <div class="products-grid">

        @foreach ($products as $product)

            <div class="product-card">

                @if($product->photos->isNotEmpty())

                    <div class="product-photo">

                        @foreach($product->photos as $photo)
                            
                            <img src="{{ asset('storage/' . $photo->photo) }}" alt="Product Photo">
                        
                        @endforeach

                    </div>

                @endif
                
                <a class="product-title" href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">
                    <h2>
                        {{ $product->name }}
                    </h2>
                </a>
                
                <p class="product-desc">{{ $product->description }}</p>

                <br>

                <p class="product-price">${{ $product->price }}</p>
                
                @if(session('success'))
                        
                    <div class="success">{{ session('success') }}</div>
                    
                    <a class="go-to-cart" href="{{ route('cart.viewCart')  }}">go to cart</a>
                
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
                
                @auth
                
                    <form class="add-to-cart" action="{{ route('cart.addToCart', $product) }}" method="post">
                        @csrf
                        <button type="submit">add to cart</button>
                    </form>

                @endauth
                    
            </div>        
        @endforeach

    </div>   
    
    <div class="pagination">

        {{ $products->links() }}

    </div>

@endsection
