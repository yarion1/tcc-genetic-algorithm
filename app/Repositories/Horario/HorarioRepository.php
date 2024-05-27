<?php

namespace App\Repositories\Horario;

use App\Models\ModelFront\Horario;
use App\Repositories\BaseRepository;

class HorarioRepository extends BaseRepository
{
    protected $model;

    public function __construct(Horario $model)
    {
        $this->model = $model;
    }
}
