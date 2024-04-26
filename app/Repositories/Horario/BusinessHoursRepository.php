<?php

namespace App\Repositories\Horario;

use App\Models\ModelFront\BusinessHours;
use App\Repositories\BaseRepository;

class BusinessHoursRepository extends BaseRepository
{
    protected $model;

    public function __construct(BusinessHours $model)
    {
        $this->model = $model;
    }
}
