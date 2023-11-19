<?php

use Illuminate\Database\Eloquent\Model;

class VariationAttributeValue extends Model
{
    protected $fillable = [
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
}
