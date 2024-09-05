<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_pins', function (Blueprint $table) {
            $table->dropColumn('wp_order_id');

            $table->renameColumn('wp_order_item_id', 'order_item_id');

            $table->foreign('order_item_id')
                ->references('id')
                ->on('order_items')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_pins', function (Blueprint $table) {
            // Drop foreign key for 'order_item_id'
            $table->dropForeign(['order_item_id']);

            // Rename 'order_item_id' back to 'wp_order_item_id'
            $table->renameColumn('order_item_id', 'wp_order_item_id');

            // Add the 'wp_order_id' column back
            $table->unsignedBigInteger('wp_order_id')->nullable();
        });
    }
};
