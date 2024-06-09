<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use App\Models\ProfessorSchedule;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class Horario extends BaseModel
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
        'horario',
   ];

    public function horario(): HasMany
    {
        return $this->hasMany(ProfessorSchedule::class, 'horario_id');
    }

    public function scopeOrderHorarioFilho(EloquentBuilder $query): void
    {
        // $query->orderByRaw("string_to_array(versao, '.')");
        $query->orderByRaw("
        CAST(SUBSTRING_INDEX(versao, '.', 1) AS UNSIGNED) ASC,
        CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(versao, '.', 2), '.', -1) AS UNSIGNED) ASC,
        CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(versao, '.', 3), '.', -1) AS UNSIGNED) ASC,
        LENGTH(versao) ASC,
        versao ASC
    ");
    }
}
