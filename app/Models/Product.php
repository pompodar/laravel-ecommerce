<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Product extends Model
{
    use HasFactory;

    public static function rules($id = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => [Rule::unique('products')->ignore($id)],
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'exists:categories,id',
            'tags' => 'array',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        return $rules;
    }

    protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'currency', 'photo_path', 'category_id'];

     public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
