<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableTransactionSaving extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan migrate --path=/database/migrations/2025_03_05_151216_add_table_transaction_saving.php

    public function up()
    {
        Schema::table('saving_transactions', function (Blueprint $table) {
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
