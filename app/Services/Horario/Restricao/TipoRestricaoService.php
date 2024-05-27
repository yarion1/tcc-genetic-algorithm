<?php

namespace App\Services\Horario\Restricao;

use App\Repositories\Horario\Restricao\TipoRestricaoRepository;
use App\Services\BaseService;

class TipoRestricaoService extends BaseService
{
    protected $repository;

    public function __construct(TipoRestricaoRepository $repository)
    {
        $this->repository = $repository;
    }
}
