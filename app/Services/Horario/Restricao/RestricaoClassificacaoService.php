<?php

namespace App\Services\Horario\Restricao;

use App\Repositories\Horario\Restricao\RestricaoClassificacaoRepository;
use App\Services\BaseService;

class RestricaoClassificacaoService extends BaseService
{
    protected $repository;

    public function __construct(RestricaoClassificacaoRepository $repository)
    {
        $this->repository = $repository;
    }
}
