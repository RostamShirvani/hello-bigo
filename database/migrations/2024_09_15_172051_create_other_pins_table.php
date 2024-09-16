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
        Schema::create('other_pins', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('pin');
            $table->tinyInteger('app_type');
            $table->decimal('amount', 25, 2);
            $table->integer('value');
            $table->tinyInteger('status')->default(0); // Adjust the default as needed
            $table->tinyInteger('state')->default(1); // Adjust the default as needed
            $table->foreignId('order_id')->nullable()->references('id')->on('orders')->onDelete('SET NULL');
            $table->foreignId('order_item_id')->nullable()->references('id')->on('order_items')->onDelete('SET NULL');
            $table->string('tracking_code', 50)->nullable();
            $table->string('used_by_mobile', 15)->nullable();
            $table->string('description')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('used_by')->nullable()->references('id')->on('users')->onDelete('SET NULL');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_pins');
    }
};
