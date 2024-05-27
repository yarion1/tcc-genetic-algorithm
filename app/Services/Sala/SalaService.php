<?php

namespace App\Services\Sala;

use App\Repositories\Sala\SalaRepository;
use App\Services\BaseService;
use Exception;

class SalaService extends BaseService
{
    protected $repository;

    public function __construct(SalaRepository $repository)
    {
        $this->repository = $repository;
    }
}
