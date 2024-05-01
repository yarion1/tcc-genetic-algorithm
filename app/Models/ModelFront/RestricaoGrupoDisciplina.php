<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Course;

class RestricaoGrupoDisciplina extends BaseModel
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
         return $this->BelongsTo(Course::class, 'disciplina_id');
    }
}
