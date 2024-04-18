<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Perfil extends BaseModel
{
    protected $table = 'perfis';

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
