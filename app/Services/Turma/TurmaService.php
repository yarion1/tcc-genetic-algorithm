<?php

namespace App\Services\Turma;

use App\Repositories\Turma\TurmaRepository;
use App\Services\BaseService;
use Exception;

class TurmaService extends BaseService
{

    protected $repository;

    public function __construct(TurmaRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function beforeCreate(array $inputData): array
    {
        return $inputData;
    }
}
