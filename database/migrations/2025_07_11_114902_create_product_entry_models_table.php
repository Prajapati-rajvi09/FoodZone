<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductEntryModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_entry_models', function (Blueprint $table) {
            $table->id();
          
            $table->string('pnameid', '50');
           
            $table->string('size', '50');
            
            $table->string('image', '100');
            $table->string('image1', '100');
            $table->string('image2', '100');
            $table->string('image3', '100');
            $table->string('image4', '100');
            $table->boolean('productstatus')->default(1);
            $table->string('price', '100');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_entry_models');
    }
}
