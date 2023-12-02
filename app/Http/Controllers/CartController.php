<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();

        $product_id = $request->input('product_id');

        $quantity = $request->input('quantity');

        $variations = ProductVariation::where('product_id', $product_id)->get();

        $hasVariations = $variations->isNotEmpty();

        $hasVariations ? $variation_id = $request->input('variation_id') : $variation_id = null;
        
        // $product_variation = ProductVariation::find($variationId);

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();

        
    // Validate quantity against stock
    $product = Product::find($product_id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    if ($quantity > $product->stock) {
        return response()->json(['message' => 'Not enough stock available'], 422);
    }

        if ($cartItem) {
            // Check if the existing cart item has the same variation_id
            if ($cartItem->variation_id == $variation_id) {
                // Update quantity if the product with the same variation is already in the cart
                $cartItem->increment('quantity');
            } else {
                // Add a new item to the cart with a different variation_id
                $user->cart()->create([
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'variation_id' => $variation_id,
                ]);
            }
        } else {
            // Add a new item to the cart if it doesn't exist
            $user->cart()->create([
                'product_id' => $product_id,
                'quantity' => 1,
                'variation_id' => $variation_id,
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);    

    }

    public function updateCart(Request $request, $cartItemId)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Find the cart item by ID for the authenticated user
        $cartItem = $user->cart()->find($cartItemId);

        // Validate the request
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:' . $cartItem->product->stock,
        ]);

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

        // Calculate totals
        $subtotal = $cartItems->sum(function ($cartItem) {
            $variations = ProductVariation::where('product_id', $cartItem->product->id)->get();

            $hasVariations = $variations->isNotEmpty();
           
            return $hasVariations ? $cartItem->quantity * $cartItem->variation->price : $cartItem->quantity * $cartItem->product->price;
        });

        $total = $subtotal; // You can add other calculations (e.g., taxes, discounts) as needed

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);

        // Delete the cart item
        $cartItem->delete();

        return redirect()->route('cart.viewCart')->with('success', 'Item removed from cart successfully');
    }


}
