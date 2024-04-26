<?php

namespace App\Repositories\Sala;

use App\Models\ModelFront\Sala;
use App\Repositories\BaseRepository;

class SalaRepository extends BaseRepository
{
    protected $model;

    public function __construct(Sala $model)
    {
        $this->model = $model;
    }
}
