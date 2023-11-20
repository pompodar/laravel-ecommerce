<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Update quantity if the product is already in the cart
            $cartItem->increment('quantity');
        } else {
            // Add a new item to the cart
            $user->cart()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('home.index')->with('success', 'Product added to cart successfully');
    }

    public function updateCart(Request $request, $cartItemId)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1', // Add any additional validation rules as needed
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Find the cart item by ID for the authenticated user
        $cartItem = $user->cart()->find($cartItemId);

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found');
        }

        // Update the quantity of the cart item
        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('cart.viewCart')->with('success', 'Cart item quantity updated successfully');
    }

    public function viewCart()
    {
        $user = Auth::user();
        
        $cartItems = $user->cart()->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

}
