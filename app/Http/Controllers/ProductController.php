<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
     public function index()
    {
        $products = Product::paginate(1);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $attributes = Attribute::all();

        return view('admin.products.create', compact('categories', 'tags', 'attributes'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|unique:products|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'tags' => 'array',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'categories' => 'array',
            'attributes' => 'array',
        ]);

        // Validation
        $validator = Validator::make($request->all(), Product::rules());

        if ($validator->fails()) {
            return redirect()
                ->route('admin.products.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        // Handle photo upload if provided
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('product_photos', 'public');
        }

        // Generate slug using Str::slug
        $slug = Str::slug($request->input('name'));

        // Create product
        $product = Product::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $photoPath,
        ]);

        // Attach tags
        $product->tags()->attach($request->input('tags'));

        // Attach category if provided
        if ($request->has('category_id')) {
            $product->category()->associate($request->input('category_id'))->save();
        }

        // Attach category if provided
        if ($request->has('attribute_id')) {
            $product->attribute()->associate($request->input('attribute_id'))->save();
        }

        // $product->photos()->create([
        //     'photo' => $photoPath,
        // ]);

        // Attach categories to the product
        $product->categories()->sync($request->input('categories'));

        // Attach categories to the product
        $product->attributes()->sync($request->input('attributes'));

        return redirect()->route('admin.products.create')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $selectedCategories = $product->categories->pluck('id')->toArray();

        $attributes = Attribute::all();
        $selectedAttributes = $product->attributes->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'selectedCategories', 'attributes', 'selectedAttributes'));
    }

    public function update(Request $request, Product $product)
    {
        // Validation rules for updating the product
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'attributes' => 'array',
            'attributes.*' => 'exists:attributes,id',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('product_photos', 'public');
            $product->update(['image' => $photoPath]);
        }

        $slug = Str::slug($request->input('name'));

        // Update the product details
        $product->update([
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ]);

        // Sync categories
        $product->categories()->sync($request->input('categories'));

        // Sync attributes
        $product->attributes()->sync($request->input('attributes'));

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
