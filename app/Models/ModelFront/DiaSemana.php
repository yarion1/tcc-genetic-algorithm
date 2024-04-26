<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;

class DiaSemana extends BaseModel
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

    public function eventos()
    {
        return $this->belongsToMany(Evento::class);
    }
}
