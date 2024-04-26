<?php

namespace App\Repositories\Horario;

use App\Models\ModelFront\HorarioEvento;
use App\Repositories\BaseRepository;

class HorarioEventoRepository extends BaseRepository
{
    protected $model;

    public function __construct(HorarioEvento $model)
    {
        $this->model = $model;
    }
}
