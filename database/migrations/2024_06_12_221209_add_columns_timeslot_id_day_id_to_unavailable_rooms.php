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
        Schema::table('unavailable_rooms', function (Blueprint $table) {
            $table->integer('timeslot_id')->unsigned();
            $table->integer('day_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unavailable_rooms', function (Blueprint $table) {
            //
        });
    }
};
