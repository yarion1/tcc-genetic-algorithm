<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisciplinasProfessores extends BaseModel
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

    public function disciplina(): BelongsTo
    {
        return $this->BelongsTo(Disciplina::class, 'disciplina_id');
    }
}
