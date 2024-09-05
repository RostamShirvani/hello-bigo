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
        Schema::create('payment_pins', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('serial_number');
            $table->string('pin');
            $table->decimal('amount', 25, 2);
            $table->unsignedBigInteger('value');
            $table->unsignedBigInteger('likee_value')->nullable();
            $table->smallInteger('status')->default(0); // Adjust the default as needed
            $table->smallInteger('state')->default(1); // Adjust the default as needed
            $table->smallInteger('order_app_type')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->string('wp_order_id', 50)->nullable();
            $table->string('wp_order_item_id', 50)->nullable();
            $table->string('tracking_code', 50)->nullable();
            $table->string('used_by_mobile', 15)->nullable();
            $table->json('extra')->nullable(); // Use json instead of jsonb for wider DB compatibility
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('used_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('deleted_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('payment_pins');
    }
};
