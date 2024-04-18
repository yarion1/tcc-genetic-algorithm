<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TiposSalas extends BaseModel
{
    protected $table = 'tipos_salas';

    protected $appends = ['select_text'];

    protected $guarded = [
        'ativo',
        'criado_por',
        'criado_em',
        'atualizado_por',
        'atualizado_em',
        'excluido_por',
        'excluido_em'
    ];
    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

  protected function selectText(): Attribute
  {
      return new Attribute(
          get: fn () => sprintf($this->sigla) . ' - ' . $this->nome,
      );
  }

  public function salas()
    {
        return $this->hasMany(Sala::class);
    }
}
