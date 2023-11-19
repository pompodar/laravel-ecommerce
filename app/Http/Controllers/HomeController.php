<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
     public function index()
    {
        $products = Product::paginate(1);

        return view('home.index', compact('products'));
    }

}
