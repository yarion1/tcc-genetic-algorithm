<?php

namespace App\Services\Horario;

use App\Repositories\Horario\BusinessHoursRepository;
use App\Services\BaseService;

class BusinessHoursService extends BaseService
{
    protected $repository;

    public function __construct(BusinessHoursRepository $repository)
    {
        $this->repository = $repository;
    }
}
