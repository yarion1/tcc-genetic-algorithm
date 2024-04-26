<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;

class RestricaoClassificacao extends BaseModel
{
    protected $table = 'restricao_classificacoes';
    
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
