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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->nullable()->constrained('cursos');
            $table->foreignId('perfil_id')->nullable()->constrained('perfis');
            $table->string('cpf', 20);
            $table->string('nome');
            $table->string('senha')->nullable();
            $table->string('apelido')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verificado_em')->nullable();

            $table->rememberToken();

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
        Schema::dropIfExists('pessoas');
    }
};