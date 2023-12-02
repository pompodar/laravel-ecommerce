<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
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
            return $cartItem->variation ? $cartItem->variation->price * $cartItem->quantity : $cartItem->product->price * $cartItem->quantity;
        });

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }
    
    public function checkout()
    {
        $user = Auth::user();

        // Retrieve cart items
        $cartItems = $user->cart;

        // Calculate total price, considering variation prices
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->variation ? $cartItem->variation->price * $cartItem->quantity : $cartItem->product->price * $cartItem->quantity;
        });

        // Create an order based on cart items
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice, // Assuming you have a 'total_price' column in your orders table
        ]);

        // Move cart items to order_items table
        foreach ($cartItems as $cartItem) {
            // Check if the cart item has a variation
            if ($cartItem->variation) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'variation_id' => $cartItem->variation->id,
                    'price' => $cartItem->variation->price, // Assuming you have a 'price' column in your order_items table
                ]);
            } else {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price, // Assuming you have a 'price' column in your order_items table
                ]);
            }
        }

        // Reduce stock
        $cartItem->product->decrement('stock', $cartItem->quantity);

        // Clear the user's cart
        $user->cart()->delete();

        return view('checkout.success', compact('order'));
    }
}
