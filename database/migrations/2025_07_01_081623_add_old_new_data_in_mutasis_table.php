<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mutasis', function (Blueprint $table) {
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutasis', function (Blueprint $table) {
            $table->dropColumn('old_data');
            $table->dropColumn('new_data');
        });
    }
};
