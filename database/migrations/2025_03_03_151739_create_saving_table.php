<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan migrate --path=/database/migrations/2025_03_03_151739_create_saving_table.php

    public function up()
    {
        Schema::create('cifs', function (Blueprint $table) {
            $table->id();
            $table->string("cif_name");
            $table->string("cif_nik")->unique();
            $table->string("cif_phone");
            $table->string("cif_email");
            $table->string("cif_address")->nullable();
            $table->timestamps();
             $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        Schema::create('saving_types', function (Blueprint $table) {
            $table->id();
            $table->string("saving_type_name");
            $table->string("saving_type_desc")->nullable();
            $table->timestamps();
             $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        Schema::create('saving_segments', function (Blueprint $table) {
            $table->id();
            $table->string("saving_segment_name");
            $table->double("limit_amount");
            $table->unsignedInteger("saving_type_id");
            $table->foreign('saving_type_id')->references('id')->on('saving_types');
            $table->timestamps();
             $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("cif_id");
            $table->string("account_number");
            $table->string("account_pin")->nullable();
            $table->double("balance");
            $table->unsignedInteger("saving_segment_id");
            $table->foreign('saving_segment_id')->references('id')->on('saving_segments');
            $table->foreign('cif_id')->references('id')->on('cifs');
            $table->timestamps();
             $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        Schema::create('saving_transactions', function (Blueprint $table) {
            $table->id();
            $table->string("reference_number");
            $table->string("saving_reference_number");
            $table->string("dc_type");
            $table->double("transaction_amount");
            $table->string("transaction_code");
            $table->unsignedInteger("account_id");
            $table->string("account_number");
            $table->double("last_balance");
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('saving_transactions');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('saving_segments');
        Schema::dropIfExists('saving_types');
        Schema::dropIfExists('cifs');
    }
}
