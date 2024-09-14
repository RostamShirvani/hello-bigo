<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->foreignId('created_by')->after('updated_at')->nullable()->references('id')->on('users')->onDelete('SET NULL');
            $table->foreignId('updated_by')->after('created_by')->nullable()->references('id')->on('users')->onDelete('SET NULL');;
            $table->tinyInteger('status')->after('updated_by')->default(1);
            $table->tinyInteger('pay_gateway')->after('status')->nullable();
            $table->tinyInteger('zarinpal_gateway')->after('pay_gateway')->nullable();
            $table->tinyInteger('zibal_gateway')->after('zarinpal_gateway')->nullable();
            $table->tinyInteger('sms_channel')->after('zibal_gateway')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'status', 'pay_gateway', 'zarinpal_gateway', 'zibal_gateway', 'sms_channel']);
        });
    }
};
