<?php

namespace App\Repositories\Horario;

use App\Models\ModelFront\Evento;
use App\Repositories\BaseRepository;

class EventoRepository extends BaseRepository
{
    protected $model;

    public function __construct(Evento $model)
    {
        $this->model = $model;
    }
}
