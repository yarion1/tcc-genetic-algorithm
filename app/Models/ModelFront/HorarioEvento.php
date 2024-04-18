<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HorarioEvento extends BaseModel
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

     public function horario(): BelongsTo
     {
          return $this->belongsTo(Horario::class, 'horario_id');
     }

     public function events(): HasMany
     {
          return $this->HasMany(Evento::class, 'horario_evento_id');
     }

     public function eventoDias(): HasMany
     {
          return $this->hasMany(EventoDia::class, 'evento_id');
     }
}
