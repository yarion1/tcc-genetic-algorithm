<?php

namespace App\Services\Horario;
use App\Repositories\Horario\DayRepository;
use App\Services\BaseService;

class DayService extends BaseService
{
    protected $repository;

    public function __construct(DayRepository $repository)
    {
        $this->repository = $repository;
    }
}
