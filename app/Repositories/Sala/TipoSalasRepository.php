<?php

namespace App\Repositories\Sala;

use App\Models\ModelFront\TiposSalas;
use App\Repositories\BaseRepository;

class TipoSalasRepository extends BaseRepository
{
    protected $model;

    public function __construct(TiposSalas $model)
    {
        $this->model = $model;
    }
}
