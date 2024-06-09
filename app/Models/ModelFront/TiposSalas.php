<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use App\Models\Room;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

  public function salas() : HasMany
    {
        return $this->hasMany(Room::class, 'tipo_sala_id');
    }
}
