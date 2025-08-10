<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        // php artisan migrate --path=database/migrations/2025_08_07_081709_add_token_table.php

    public function up()
    {
         Schema::create('cifs', function (Blueprint $table) {
            $table->id();
            $table->string("cif_name");
            $table->string("cif_no_id");
            $table->string("cif_type_id");
            $table->string("cif_id_index")->unique();
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
         Schema::create('user_apps', function (Blueprint $table) {
            $table->id();
            $table->string("username");
            $table->string("password");
            $table->string("name");
            $table->string("identity_type")->default('NIK') ;
            $table->string("identity_number")->nullable();
            $table->string("phone")->nullable();
            $table->string("email");
            $table->string("gender")->nullable();
            $table->string("province")->nullable();
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->unsignedInteger("cif_id");
            $table->foreign('cif_id')->references('id')->on('cifs');
            $table->string("status")->default('active');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("cif_id");
            $table->string("username");
            $table->string("phone")->unique();
            $table->string("otp")->unique();
            $table->foreign('cif_id')->references('id')->on('cifs');
            $table->string("expired_duration");
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
        Schema::create('saving_transactions', function (Blueprint $table) {
            $table->id();
            $table->string("reference_number");
            $table->string("reference_number_partner");
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
        Schema::dropIfExists('otps');
        Schema::dropIfExists('user_apps');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('saving_segments');
        Schema::dropIfExists('saving_types');
        Schema::dropIfExists('cifs');
    }
}
