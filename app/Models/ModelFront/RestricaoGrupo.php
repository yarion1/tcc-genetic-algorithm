<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestricaoGrupo extends BaseModel
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

    public function restricao(): BelongsTo
     {
          return $this->belongsTo(RestricaoGrupo::class, 'restricao_id');
     }

     public function events(): HasMany
     {
          return $this->HasMany(RestricaoGrupoEvento::class, 'restricao_grupo_id');
     }
}
