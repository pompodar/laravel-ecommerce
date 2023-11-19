<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\VariationAttribute;
use App\Models\VariationAttributeValue;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function create($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404); 
        }

        //$attributes = VariationAttribute::all();
        return view('admin.variations.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'attributes' => 'required|array',
            'attributes.*.attribute_id' => 'required|exists:variation_attributes,id',
            'attributes.*.value' => 'required|string',
        ]);

        $variation = ProductVariation::create([
            'product_id' => $product->id,
            'price' => $request->input('price'),
        ]);

        foreach ($request->input('attributes') as $attribute) {
            VariationAttributeValue::create([
                'product_variation_id' => $variation->id,
                'attribute_id' => $attribute['attribute_id'],
                'value' => $attribute['value'],
            ]);
        }

        return redirect()->route('admin.products.show', $product)->with('success', 'Variation added successfully');
    }
}
