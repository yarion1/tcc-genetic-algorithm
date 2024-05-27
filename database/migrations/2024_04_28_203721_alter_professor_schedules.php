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
        Schema::table('professor_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('horario_id')->nullable();
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professor_schedules', function (Blueprint $table) {
            $table->dropForeign(['horario_id']); // Remove a chave estrangeira
            $table->dropColumn('horario_id'); // Remove a coluna
        });
    }
};
