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
            $table->tinyInteger('type');
            $table->decimal('amount', 25, 2);
            $table->integer('value');
            $table->tinyInteger('status')->default(0); // Adjust the default as needed
            $table->tinyInteger('state')->default(1); // Adjust the default as needed
            $table->string('used_by_mobile', 15)->nullable();
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
