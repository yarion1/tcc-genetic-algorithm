<?php

namespace App\Repositories\Horario\Restricao;

use App\Models\TipoRestricao;
use App\Repositories\BaseRepository;

class TipoRestricaoRepository extends BaseRepository
{
    protected $model;

    public function __construct(TipoRestricao $model)
    {
        $this->model = $model;
    }
}
