<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationPhoto extends Model
{
    protected $fillable = ['photo'];

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }
}
