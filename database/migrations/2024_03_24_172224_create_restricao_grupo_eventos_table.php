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
        Schema::create('restricao_grupo_eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restricao_grupo_id')->constrained('restricao_grupos');
            $table->foreignId('tipo_restricao_id')->constrained('tipo_restricoes');
            $table->foreignId('classificacao_id')->constrained('restricao_classificacoes');
            $table->string('title');
            $table->time('startTime');
            $table->time('endTime');
            $table->unsignedBigInteger('daysOfWeek')->nullable()->constrained('days');

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
        Schema::dropIfExists('restricao_grupo_eventos');
    }
};