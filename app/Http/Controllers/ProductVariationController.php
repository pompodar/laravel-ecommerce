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
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404); 
        }

        return view('admin.variations.index', compact('product'));
    }

    public function create($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404); 
        }

        return view('admin.variations.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'attributes' => 'required|array',
            // 'attributes.*.attribute_id' => 'required|exists:variation_attributes,id',
            // 'attributes.*.value' => 'required|string',
        ]);

        $product = Product::find($request->input('product_id'));

        $variation = ProductVariation::create([
            'product_id' => $request->input('product_id'),
            'price' => $request->input('price'),
        ]);        

        foreach ($request->input('attributes') as $attribute) {
            VariationAttributeValue::create([
                'product_variation_id' => $variation->id,
                'attribute_id' => $attribute['attribute_id'],
                'value' => $attribute['value'],
            ]);
        }

        return redirect()->route("admin.variations.index", $product->slug)->with('success', 'Variation added successfully');
    }
}
