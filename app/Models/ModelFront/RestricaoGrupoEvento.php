<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestricaoGrupoEvento extends BaseModel
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

     public $cascadeDelete = [
          'disciplinas',
          'salas',
     ];


     public function classificacao(): BelongsTo
     {
          return $this->BelongsTo(RestricaoClassificacao::class, 'classificacao_id');
     }

     public function restricao(): BelongsTo
     {
          return $this->BelongsTo(RestricaoGrupo::class, 'restricao_grupo_id');
     }

     public function salas(): HasMany
     {
          return $this->hasMany(RestricaoGrupoSala::class, 'restricao_grupo_evento_id');
     }

     public function disciplinas(): HasMany
     {
          return $this->hasMany(RestricaoGrupoDisciplina::class, 'restricao_grupo_evento_id');
     }
}
