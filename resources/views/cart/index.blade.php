@extends('layouts.app')

@section('content')
    <h1>Shopping Cart</h1>

    <hr>

    <div class="cart-items">
        
        <div class="cart-item">

            @foreach ($cartItems as $cartItem)
    
                <p> {{ $cartItem->product->name }} </p>
                
                <form action="{{ route('cart.updateCart', ['cartItemId' => $cartItem->id]) }}" method="post">
                    @csrf
                    @method('patch')

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">

                    <button type="submit">Change Quantity</button>
                </form>

                
                    <p> {{ $cartItem->product->price }} </p>
    
            @endforeach


        </div>
    
    </div>

@endsection
