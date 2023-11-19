<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);

        // Generate slug using Str::slug
        $slug = Str::slug($request->input('name'));

        Category::create([
            'name' => $request->input('name'),
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categories.create')->with('success', 'Category created successfully');
    }
}
