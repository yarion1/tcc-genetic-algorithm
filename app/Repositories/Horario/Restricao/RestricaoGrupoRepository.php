<?php

namespace App\Repositories\Horario\Restricao;

use App\Models\ModelFront\RestricaoGrupo;
use App\Repositories\BaseRepository;

class RestricaoGrupoRepository extends BaseRepository
{
    protected $model;

    public function __construct(RestricaoGrupo $model)
    {
        $this->model = $model;
    }
}
