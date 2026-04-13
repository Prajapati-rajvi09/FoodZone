<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_models', function (Blueprint $table) {
            $table->id();
            $table->string('productid','10');
            $table->string('userid','100');
            $table->string('qty','10');
            $table->string('pprice','10');
            $table->boolean('billno')->default(0);
            $table->string('pstatus','10');

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
        Schema::dropIfExists('cart_models');
    }
}
