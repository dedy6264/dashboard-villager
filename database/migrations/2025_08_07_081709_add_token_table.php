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
 Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_app_id");
            $table->string("username");
            $table->string("phone");
            $table->string("otp")->unique();
            $table->foreign('user_app_id')->references('id')->on('user_apps');
            $table->string("expired_duration");
            $table->timestamps();
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
        Schema::dropIfExists('otps');

    }
}
