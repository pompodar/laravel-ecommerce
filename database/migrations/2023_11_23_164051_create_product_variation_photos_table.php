<?php
// database/migrations/xxxx_xx_xx_create_product_variation_photos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('product_variation_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variation_id')->constrained()->onDelete('cascade');
            $table->string('photo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variation_photos');
    }
}
