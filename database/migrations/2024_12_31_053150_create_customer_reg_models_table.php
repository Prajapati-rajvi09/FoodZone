<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRegModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_reg_models', function (Blueprint $table) {
            $table->id();
            $table->string('name','50');
            $table->string('address','100');
            $table->string('city','50');
            $table->enum('gender',["Male","Female"])->nullable();
            $table->string('mobileno','20');
            $table->date('dob');
            $table->string('emailid','50');
            $table->string('password','50');
            $table->boolean('status')->default(1);
        
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
        Schema::dropIfExists('customer_reg_models');
    }
}
