<?php

namespace App\Models;

use App\Models\ModelFront\Base\BaseModel;

class NotificacaoHorario extends BaseModel
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
}
