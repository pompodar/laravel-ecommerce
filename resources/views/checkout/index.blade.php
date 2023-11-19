@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>

    <div>
        <h2>Order Summary</h2>

        <!-- Display order items -->
        <ul>
            @foreach($cartItems as $cartItem)
                <li>{{ $cartItem->product->name }} - Quantity: {{ $cartItem->quantity }}</li>
            @endforeach
        </ul>

        <!-- Display total price -->
        <p>Total: ${{ $totalPrice }}</p>
    </div>

    <div>
        <h2>Shipping Information</h2>

        <!-- Add form fields for shipping information as needed -->
        <form action="{{ route('checkout.proccess') }}" method="post">
            @csrf

            <!-- Add form fields for shipping information (e.g., name, address, etc.) -->

            <button type="submit">Place Order</button>
        </form>
    </div>
@endsection
