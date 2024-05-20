<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use App\Models\ProfessorSchedule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horario extends BaseModel
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

    public function horario(): HasMany
    {
        return $this->hasMany(ProfessorSchedule::class, 'horario_id');
    }
}
