@extends('layouts.app')

@section('content')

    <div class="single-product">

        <div class="product-card">

            @if($product->photos->isNotEmpty())

                <div class="product-photo">

                    @foreach($product->photos as $photo)
                        
                        <img src="{{ '/' . $photo->photo }}" alt="Product Photo">
                    
                    @endforeach

                </div>

            @endif
            
            <h2 class="product-title">
                
                {{ $product->name }}
            
            </h2>
            
            <p class="product-desc">{{ $product->description }}</p>

            <br>

            <p class="product-price">${{ $product->price }}</p>
                
        </div> 

        <div class="product-variations__form">
            
                <form class="add-to-cart__form" action="{{ route('cart.addToCart', $product) }}" method="post">
                    @csrf

                    <div class="product-variations">
                    
                        @foreach ($product->variations as $variation)

                            <div class="product-variation">

                                <div class="product-variations__photo">
                                    @foreach ($variation->photos as $photo)
                                        <div class="col-md-3">
                                            <img src="{{ '/' . $photo->photo }}" alt="Product Photo">
                                        </div>
                                    @endforeach
                                </div>

                                <p class="product-variation__price">${{ $variation->price }}</p>

                                @if ($variation->attributeValues->isNotEmpty())
                                    <ul class="product-variation__attributes">
                                        @foreach ($variation->attributeValues as $attribute)
                                            
                                            <input class="form-check-input" type="radio" name="variation_id" id="variation_{{ $variation->id }}" value="{{ $variation->id }}" required>
                                            
                                            <label class="form-check-label" for="variation_{{ $variation->id }}">
                                            
                                                {{ $attribute->attribute->name }}
                                                
                                                {{ $attribute->value }}
                                            
                                            </label>    
                                            
                                            <!-- <li>{{ $attribute->attribute->name }}: {{ $attribute->value }}</li> -->
                                        
                                        @endforeach
                                    </ul>
                                @endif
    
                            </div>    
                    
                        @endforeach

                    </div>    
                    
                    @auth

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

                        <button class="add-to-cart" type="submit">add to cart</button>

                    @endauth

                </form>
        
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