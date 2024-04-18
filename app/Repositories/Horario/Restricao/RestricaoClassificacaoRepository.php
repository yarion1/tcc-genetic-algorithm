<?php

namespace App\Repositories\Horario\Restricao;

use App\Models\RestricaoClassificacao;
use App\Repositories\BaseRepository;

class RestricaoClassificacaoRepository extends BaseRepository
{
    protected $model;

    public function __construct(RestricaoClassificacao $model)
    {
        $this->model = $model;
    }
}
