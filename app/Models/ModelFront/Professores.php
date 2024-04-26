<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professores extends BaseModel
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

    public function pessoa(): BelongsTo
    {
        return $this->BelongsTo(Pessoa::class, 'pessoa_id');
    }

    public function disciplinas(): HasMany
    {
        return $this->hasMany(DisciplinasProfessores::class, 'professor_id');
    }

    public function disponibilidades(): HasMany
    {
        return $this->hasMany(DisponibilidadesProfessores::class, 'professor_id');
    }

    public function prioridades(): HasMany
    {
        return $this->hasMany(PrioridadesProfessores::class, 'professor_id');
    }
}
