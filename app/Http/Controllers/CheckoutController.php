<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve cart items
        $cartItems = $user->cart;

        // Calculate total price
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }
    
    public function checkout()
    {
        $user = Auth::user();

        // Retrieve cart items
        $cartItems = $user->cart;

        // Calculate total price
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        // Create an order based on cart items
        $order = Order::create([
            'user_id' => $user->id,
            // Add other order details as needed
        ]);

        // Move cart items to order_items table
        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
            ]);
        }

        // Clear the user's cart
        $user->cart()->delete();

        return view('checkout.success', compact('order'));
    }
}
