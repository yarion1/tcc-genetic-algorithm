<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;

class TipoRestricao extends BaseModel
{
    protected $table = 'tipo_restricoes';
    protected $guarded = [
        'ativo',
        'criado_por',
        'criado_em',
        'atualizado_por',
        'atualizado_em',
        'excluido_por',
        'excluido_em'
    ];
}
