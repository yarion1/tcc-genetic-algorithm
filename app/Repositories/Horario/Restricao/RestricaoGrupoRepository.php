<?php

namespace App\Repositories\Horario\Restricao;

use App\Models\RestricaoGrupo;
use App\Repositories\BaseRepository;

class RestricaoGrupoRepository extends BaseRepository
{
    protected $model;

    public function __construct(RestricaoGrupo $model)
    {
        $this->model = $model;
    }
}
