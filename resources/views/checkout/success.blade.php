@extends('layouts.app')

@section('content')

    <section class="breadcrumb-section set-bg" data-setbg="/front_end_assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thank you!</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
    
                    <h1>Order Successful!!</h1>

                    <p>Your order has been placed successfully. Order details: Order ID: {{ $order->id }}</p>

                    <p>You can find more information in dashboard.</p>

                </div>
        
            </div>
        
        </div>

    </section>

@endsection
