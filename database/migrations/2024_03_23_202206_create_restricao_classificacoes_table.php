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
        Schema::create('restricao_classificacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('peso');
            $table->string('cor_destaque');

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
        Schema::dropIfExists('restricao_classificacoes');
    }
};