<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldMerchantOutlet extends Migration
{
    // php artisan migrate --path=/database/migrations/2025_03_04_103135_add_field_merchant_outlet.php

    public function up()
    {
        Schema::table('merchant_outlets', function (Blueprint $table) {
            $table->string("saving_account")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
