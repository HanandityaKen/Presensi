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
        Schema::table('presence', function (Blueprint $table) {
            $table->dropColumn('presence_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presence', function (Blueprint $table) {
            $table->enum('presence_status', ['clocked_in', 'clocked_out'])->default('clocked_in');
        });
    }
};
