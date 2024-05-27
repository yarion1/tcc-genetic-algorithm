<?php

namespace App\Services\Configuracao;

use App\Repositories\Configuracao\MenuRepository;
use App\Services\BaseService;

class MenuService extends BaseService
{
    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }
}
