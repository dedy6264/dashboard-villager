<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTrxBill extends Migration
{
    // php artisan migrate --path=/database/migrations/2024_11_12_230128_update_trx_bill.php
    // php artisan migrate:rollback --path=/database/migrations/2024_11_12_230128_update_trx_bill.php
    public function up()
    {
        Schema::create('product_references', function (Blueprint $table) {
            $table->id();
            $table->string('product_reference_name');//089.0888,08213
            $table->string('product_reference_code');
            // $table->timestamps();
        });
        Schema::create('product_helpers', function (Blueprint $table) {
            $table->id();
            $table->string('no_prefix');//089.0888,08213
            $table->unsignedInteger('product_reference_id');
            $table->foreign('product_reference_id')->references('id')->on('product_references');
            // $table->timestamps();
        });
    }
   
    public function down()
    {
        Schema::dropIfExists('product_helpers');   
        Schema::dropIfExists('product_references');
       
    }
}
