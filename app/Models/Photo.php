<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'caption'];

    public function gallery()
    {
        return $this->belongsTo(PhotoGallery::class);
    }
}
