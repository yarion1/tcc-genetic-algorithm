<?php

namespace App\Repositories\Horario;
use App\Models\Day;
use App\Repositories\BaseRepository;

class DayRepository extends BaseRepository
{
    protected $model;

    public function __construct(Day $model)
    {
        $this->model = $model;
    }
}
