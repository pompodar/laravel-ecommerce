<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();

        $variations = ProductVariation::where('product_id', $product->id)->get();

        $hasVariations = $variations->isNotEmpty();

        $hasVariations ? $variation_id = $request->input('variation_id') : $variation_id = null;
        
        // $product_variation = ProductVariation::find($variationId);

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Check if the existing cart item has the same variation_id
            if ($cartItem->variation_id == $variation_id) {
                // Update quantity if the product with the same variation is already in the cart
                $cartItem->increment('quantity');
            } else {
                // Add a new item to the cart with a different variation_id
                $user->cart()->create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'variation_id' => $variation_id,
                ]);
            }
        } else {
            // Add a new item to the cart if it doesn't exist
            $user->cart()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'variation_id' => $variation_id,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully');
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
        
        $cartItems = Cart::with('product', 'variation')->where('user_id', $user->id)->get();

        return view('cart.index', compact('cartItems'));
    }

}
