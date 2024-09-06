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
        Schema::table('razer_accounts', function (Blueprint $table) {
            $table->dropColumn('manual_updated_at'); // Remove manual_updated_at
            $table->timestamp('bigo_updated_at')->nullable()->after('priority'); // Add bigo_updated_at
            $table->timestamp('pubg_updated_at')->nullable()->after('bigo_updated_at');; // Add pubg_updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('razer_accounts', function (Blueprint $table) {
            $table->timestamp('manual_updated_at')->nullable(); // Re-add manual_updated_at
            $table->dropColumn(['bigo_updated_at', 'pubg_updated_at']); // Remove bigo_updated_at and pubg_updated_at
        });
    }
};
