<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventoDia extends BaseModel
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

    public function daysOfWeek(): HasMany
    {
         return $this->hasMany(DiaSemana::class, 'dia_semana_id');
    }

    public function evento(): BelongsTo
    {
         return $this->belongsTo(Horario::class, 'evento_id');
    }
}
