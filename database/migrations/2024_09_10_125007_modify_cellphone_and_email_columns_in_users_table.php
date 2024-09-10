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
        Schema::table('users', function (Blueprint $table) {
            DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE users MODIFY password VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE users MODIFY avatar VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE users MODIFY provider_name VARCHAR(255) NULL;');
            DB::statement('ALTER TABLE users MODIFY cellphone VARCHAR(255) NULL;');
            $table->unique('cellphone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['cellphone']);
            DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE users MODIFY cellphone VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE users MODIFY avatar VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE users MODIFY password VARCHAR(255) NOT NULL;');
            DB::statement('ALTER TABLE users MODIFY provider_name VARCHAR(255) NOT NULL;');
        });
    }
};
