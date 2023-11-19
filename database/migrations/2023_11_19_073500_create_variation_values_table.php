<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationValuesTable extends Migration
{
    public function up()
    {
        Schema::create('variation_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->string('value');
            // Add other value-specific fields
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('variation_attributes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('variation_values');
    }
}
