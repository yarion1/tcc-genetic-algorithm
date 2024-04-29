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
        Schema::table('timeslots', function (Blueprint $table) {
            $table->time('startTime');
            $table->time('endTime');
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timeslots', function (Blueprint $table) {
            $table->dropColumn(['startTime', 'endTime', 'title']);
        });
    }
};
