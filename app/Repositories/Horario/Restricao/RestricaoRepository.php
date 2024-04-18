<?php

namespace App\Repositories\Horario\Restricao;

use App\Models\Restricao;
use App\Repositories\BaseRepository;

class RestricaoRepository extends BaseRepository
{
    protected $model;

    public function __construct(Restricao $model)
    {
        $this->model = $model;
    }
}
