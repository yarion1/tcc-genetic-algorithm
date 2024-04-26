<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curso extends BaseModel
{
  protected $table = 'cursos';

  protected $appends = ['select_text'];

  protected function selectText(): Attribute
  {
      return new Attribute(
          get: fn () => sprintf($this->sigla) . ' - ' . $this->nome,
      );
  }
}
