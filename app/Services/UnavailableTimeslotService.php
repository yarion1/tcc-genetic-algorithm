<?php

namespace App\Services;

use App\Repositories\UnavailableTimeslotRepository;

class UnavailableTimeslotService extends BaseService
{
    protected $repository;

    public function __construct(UnavailableTimeslotRepository $repository)
    {
        $this->repository = $repository;
    }
}
