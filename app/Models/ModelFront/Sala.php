<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Sala extends BaseModel
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

    public function tipoSala()
    {
        return $this->belongsTo(TiposSalas::class);
    }
}
