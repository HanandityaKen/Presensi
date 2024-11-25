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
            $table->renameColumn('image_url', 'image_url_in');
            $table->time('clock_in_time');
            $table->time('clock_out_time')->nullable();
            $table->string('image_url_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presence', function (Blueprint $table) {
            $table->renameColumn('image_url_in', 'image_url'); 
            $table->dropColumn(['clock_in_time', 'clock_out_time', 'image_url_out']);
        });
    }
};
