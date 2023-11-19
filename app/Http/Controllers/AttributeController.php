<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:attributes|max:255',
        ]);

        Attribute::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.attributes.create')->with('success', 'Attribute created successfully');
    }
}
