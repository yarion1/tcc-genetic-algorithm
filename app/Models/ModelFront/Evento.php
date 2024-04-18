<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Evento extends BaseModel
{
    protected $guarded = [
        'ativo',
        'criado_por',
        'criado_em',
        'atualizado_por',
        'atualizado_em',
        'excluido_por',
        'excluido_em'
    ];

    public function eventoDias(): HasMany
    {
         return $this->hasMany(EventoDia::class, 'evento_id');
    }

    public function sala(): BelongsTo
    {
         return $this->BelongsTo(Sala::class, 'sala_id');
    }

    public function turma(): BelongsTo
    {
         return $this->BelongsTo(Turma::class, 'turma_id');
    }

    public function disciplina(): BelongsTo
    {
         return $this->BelongsTo(Disciplina::class, 'disciplina_id');
    }

    public function professor(): BelongsTo
    {
         return $this->BelongsTo(Professores::class, 'professor_id');
    }

    // public function (): HasMany
    // {
    //      return $this->hasMany(EventoDia::class, 'evento_id');
    // }

}
