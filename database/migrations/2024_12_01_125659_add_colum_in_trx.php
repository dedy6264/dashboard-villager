<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumInTrx extends Migration
{
   // php artisan migrate --path=/database/migrations/2024_12_01_125659_add_colum_in_trx.php
    // php artisan migrate:rollback --path=/database/migrations/2024_12_01_125659_add_colum_in_trx.php
    public function up()
    {
        // Schema::table('biller_trxs', function (Blueprint $table) {
        //     $table->unsignedInteger('product_reference_id')->nullable();
        //     $table->string('product_reference_code')->nullable();
        // });
        Schema::table('products', function (Blueprint $table) {
            // $table->unsignedInteger('product_reference_id')->nullable();
            $table->string('product_reference_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('biller_trxs', function (Blueprint $table) {
        //     //
        // });
    }
}
