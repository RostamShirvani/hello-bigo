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
        Schema::create('razer_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('razer_id');
            $table->string('email_address');
            $table->decimal('charge_balance', 15, 0);
            $table->string('location')->nullable();
            $table->decimal('charge_ceiling', 15, 0)->default(90000);
            $table->decimal('charge_ceil_flag', 15, 0)->default(0);
            $table->timestamp('manual_updated_at')->nullable();
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
        Schema::dropIfExists('razer_accounts');
    }
};
