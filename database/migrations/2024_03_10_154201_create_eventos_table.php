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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horario_evento_id')->constrained('horario_eventos');
            $table->time('startTime');
            $table->time('endTime');
            $table->string('title');
            $table->unsignedBigInteger('disciplina_id')->nullable()->constrained('courses');
            $table->unsignedBigInteger('professor_id')->nullable()->constrained('professors');
            $table->unsignedBigInteger('daysOfWeek')->nullable()->constrained('days');
            $table->unsignedBigInteger('sala_id')->nullable()->constrained('rooms');
            $table->boolean('ativo')->default(true);
            $table->unsignedBigInteger('criado_por')->nullable();
            $table->timestamp('criado_em')->nullable();
            $table->unsignedBigInteger('atualizado_por')->nullable();
            $table->timestamp('atualizado_em')->nullable();
            $table->unsignedBigInteger('excluido_por')->nullable();
            $table->timestamp('excluido_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};