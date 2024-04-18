<?php

namespace App\Repositories\Horario;

use App\Models\HorarioEvento;
use App\Repositories\BaseRepository;

class HorarioEventoRepository extends BaseRepository
{
    protected $model;

    public function __construct(HorarioEvento $model)
    {
        $this->model = $model;
    }
}
