<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saving_accounts', function (Blueprint $table) {
            $table->dropColumn('account_index');
            $table->unique('account_number'); // tambahkan unique constraint
        });
////
        Schema::table('clients', function (Blueprint $table) {
            $table->unique('client_name'); // tambahkan unique constraint
        });
////
        Schema::table('groups', function (Blueprint $table) {
            $table->string('group_index')->nullable();
        });
        $groups=DB::table('groups')->select('*')->get();
        foreach($groups as $group){
            DB::table('groups') ->where('id', $group->id)
                ->update([
                    'group_index' => $group->client_id . $group->group_name,
                ]);
        }
        Schema::table('groups', function (Blueprint $table) {
            $table->unique('group_index'); // tambahkan unique constraint
        });
////
        Schema::table('segments', function (Blueprint $table) {
            $table->unique('segment_name'); // tambahkan unique constraint
        });
////
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('merchant_index')->nullable();
        });
        $merchants=DB::table('merchants')->select('*')->get();
        foreach($merchants as $merchant){
            DB::table('merchants') ->where('id', $merchant->id)
                ->update([
                    'merchant_index' => $merchant->client_id . $merchant->group_name.$merchant->merchant_name,
                ]);
        }
        Schema::table('merchants', function (Blueprint $table) {
            $table->unique('merchant_index'); // tambahkan unique constraint
        });
////
        Schema::table('merchant_outlets', function (Blueprint $table) {
            $table->string('merchant_outlet_index')->unique();
            $table->string('saving_account_number')->nullable();
        });
////
        Schema::table('providers', function (Blueprint $table) {
            $table->unique('provider_name'); // tambahkan unique constraint
        });
////
        Schema::table('product_references', function (Blueprint $table) {
            $table->unique('product_reference_code'); // tambahkan unique constraint
        });
////
        Schema::table('products', function (Blueprint $table) {
            $table->unique('product_code'); // tambahkan unique constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saving_accounts', function (Blueprint $table) {
            $table->dropUnique(['account_number']); // hapus unique constraint kalau rollback
            $table->string('account_index')->nullable();
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique(['client_name']); // hapus unique constraint kalau rollback
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn(['group_index']); // hapus unique constraint kalau rollback
        });
        Schema::table('segments', function (Blueprint $table) {
            $table->dropUnique(['segment_name']); // hapus unique constraint kalau rollback
        });
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn(['merchant_index']); // hapus unique constraint kalau rollback
        });
        Schema::table('merchant_outlets', function (Blueprint $table) {
            $table->dropColumn(['merchant_index']); // hapus unique constraint kalau rollback
            $table->dropColumn(['saving_account_number']); // hapus unique constraint kalau rollback
        });
        Schema::table('providers', function (Blueprint $table) {
            $table->dropUnique(['provider_name']); // hapus unique constraint kalau rollback
        });
        Schema::table('product_references', function (Blueprint $table) {
            $table->dropUnique(['product_reference_code']); // hapus unique constraint kalau rollback
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['product_code']); // hapus unique constraint kalau rollback
        });
    }
}
