<?php

namespace App\Repositories;

use App\Models\UnavailableTimeslot;
use App\Repositories\BaseRepository;

class UnavailableTimeslotRepository extends BaseRepository
{
    public function __construct(UnavailableTimeslot $model)
    {
        $this->model = $model;
    }
}
