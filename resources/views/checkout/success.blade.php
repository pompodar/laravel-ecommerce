@extends('layouts.app')

@section('content')
    <h1>Order Successful!</h1>

    <p>Your order has been placed successfully. Order details:</p>

    <ul>
        <li>Order ID: {{ $order->id }}</li>
    </ul>
@endsection
