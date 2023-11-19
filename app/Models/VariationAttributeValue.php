<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariationAttributeValue extends Model
{
    protected $fillable = [
        'product_variation_id',
        'attribute_id',
        'value',
    ];

    public function variationAttribute()
    {
        return $this->belongsTo(VariationAttribute::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
