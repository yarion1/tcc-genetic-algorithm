<?php

namespace App\Repositories\Sala;

use App\Models\Room;
use App\Repositories\BaseRepository;

class SalaRepository extends BaseRepository
{
    protected $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }
}
