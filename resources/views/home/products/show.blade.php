@extends('layouts.app')

@section('content')

    <div class="single-product">

        <div class="product-card">

            @if($product->photos->isNotEmpty())

                <div class="product-photo">

                    @foreach($product->photos as $photo)
                        
                        <img src="{{ asset('storage/' . $photo->photo) }}" alt="Product Photo">
                    
                    @endforeach

                </div>

            @endif
            
            <h2 class="product-title">
                
                {{ $product->name }}
            
            </h2>
            
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
                
        </div> 

        <div class="product-variations">
            
                <form class="add-to-cart" action="{{ route('cart.addToCart', $product) }}" method="post">
                    @csrf
                    
                    @auth

                        <button type="submit">add to cart</button>

                    @endauth

                </form>
            
            <h3>Variations</h3>
                    
            @foreach ($product->variations as $variation)
                <p>Price: ${{ $variation->price }}</p>

                @if ($variation->attributeValues->isNotEmpty())
                    <ul>
                        @foreach ($variation->attributeValues as $attribute)
                            <li>{{ $attribute->attribute->name }}: {{ $attribute->value }}</li>
                        @endforeach
                    </ul>
                @endif
    
            @endforeach
        
        </div>

    </div>

@endsection

<script>
    // Store scroll position before leaving the page
    window.addEventListener('beforeunload', function() {
        localStorage.setItem('scrollPosition', window.scrollY);
    });

    // Restore scroll position on page load
    window.addEventListener('load', function() {
        var scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition !== null) {
            window.scrollTo(0, scrollPosition);
            localStorage.removeItem('scrollPosition');
        }
    });
</script>