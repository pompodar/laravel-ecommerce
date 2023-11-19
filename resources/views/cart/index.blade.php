@extends('layouts.app')

@section('content')
    <h1>Shopping Cart</h1>

    @foreach ($cartItems as $cartItem)
        <p>{{ $cartItem->product->name }} - Quantity: {{ $cartItem->quantity }}</p>
    @endforeach
@endsection
