<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restricao extends BaseModel
{
    protected $table = 'restricoes';
    
    protected $guarded = [
        'ativo',
        'criado_por',
        'criado_em',
        'atualizado_por',
        'atualizado_em',
        'excluido_por',
        'excluido_em'
    ];

    public function restricao(): HasMany
    {
         return $this->hasMany(RestricaoGrupo::class, 'restricao_id');
    }
}
