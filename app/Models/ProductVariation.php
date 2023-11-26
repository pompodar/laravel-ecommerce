<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'price',
    ];

    public function attributeValues()
    {
        return $this->hasMany(VariationAttributeValue::class);
    }

    public function photos()
    {
        return $this->hasMany(ProductVariationPhoto::class);
    }

    public function getAttributesString()
    {
        return $this->attributeValues->map(function ($attributeValue) {
            return $attributeValue->attribute->name . ': ' . $attributeValue->value;
        })->implode(', ');
    }
}
