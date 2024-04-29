<?php

namespace App\Repositories\Horario;

use App\Models\ProfessorSchedule;
use App\Repositories\BaseRepository;

class EventoRepository extends BaseRepository
{
    protected $model;

    public function __construct(ProfessorSchedule $model)
    {
        $this->model = $model;
    }
}
