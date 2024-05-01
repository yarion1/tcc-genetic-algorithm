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
        Schema::create('restricao_grupo_salas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restricao_grupo_evento_id')->constrained('restricao_grupo_eventos');
            $table->foreignId('sala_id')->constrained('rooms');
            
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
        Schema::dropIfExists('restricao_grupo_salas');
    }
};
