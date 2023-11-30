@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="front_end_assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="/cart">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cartItems as $cartItem)
                                
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ '/' . $cartItem->product->image }}" alt="">
                                        <h5>{{ $cartItem->product->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">

                                        @if ($cartItem->variation)
                    
                                            ${{ $cartItem->variation->price }}
                                        
                                        @else
                                        
                                            ${{ $cartItem->product->price }}

                                        @endif
                                    
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <form class="update-cart" id="update-cart" action="{{ route('cart.updateCart', ['cartItemId' => $cartItem->id]) }}" method="post">
                                                @csrf
                                                @method('patch')
                                            <div class="pro-qty">

                                                <label for="quantity"></label>
                                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                            </div>                                      
                                                <button type="submit"><i class="fa-solid fa-arrows-rotate"></i></button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{ $cartItem->product->price * $cartItem->quantity }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>{{ $total }}</span></li>
                            <li>Total <span>{{ $total }}</span></li>
                        </ul>
                        <a href="/checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    
@endsection

<!-- Your existing HTML code -->

<!-- JavaScript to update the hidden input on form submission -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // const form = document.getElementById('update-cart');
        // const quantityInput = document.getElementById('quantityInput');
        // const hiddenInput = document.querySelector('.hiddenQuantity');

        // // Add a submit event listener to the form
        // form.addEventListener('submit', function(event) {
        //     // Set the value of the hidden input to the value of the quantity input
        //     hiddenInput.value = quantityInput.value;
        // });
    });

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

<!-- Your existing HTML code -->

