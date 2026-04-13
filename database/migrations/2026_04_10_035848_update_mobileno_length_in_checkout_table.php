<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateMobilenoLengthInCheckoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Using raw SQL to avoid doctrine/dbal dependency in Laravel 8
        DB::statement('ALTER TABLE checkout_models MODIFY mobileno VARCHAR(20)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE checkout_models MODIFY mobileno VARCHAR(10)');
    }
}
