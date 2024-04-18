<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BusinessHours extends BaseModel
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

    protected $appends = ['select_text'];

    protected function selectText(): Attribute
    {
        return new Attribute(
            get: fn () => sprintf($this->nome) . ' - ' . $this->startTime . ' - ' . $this->endTime,
        );
    }
}
