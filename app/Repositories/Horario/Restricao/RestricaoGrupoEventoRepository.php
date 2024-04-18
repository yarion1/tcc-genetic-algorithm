<?php

namespace App\Repositories\Horario\Restricao;

use App\Models\RestricaoGrupoEvento;
use App\Repositories\BaseRepository;

class RestricaoGrupoEventoRepository extends BaseRepository
{
    protected $model;

    public function __construct(RestricaoGrupoEvento $model)
    {
        $this->model = $model;
    }
}
