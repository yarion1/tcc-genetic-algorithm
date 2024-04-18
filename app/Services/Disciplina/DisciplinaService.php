<?php

namespace App\Services\Disciplina;

use App\Repositories\Disciplina\DisciplinaRepository;
use App\Services\BaseService;
use Exception;

class DisciplinaService extends BaseService
{
    protected $repository;

    public function __construct(DisciplinaRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function beforeCreate(array $inputData): array
    {
        $exists = $this->repository->findByKey(query: [['nome', $inputData['nome']]])->first();

        if ($exists) {
            throw new Exception('Já existe uma disciplina com este nome.');
        }
        
        return $inputData;
    }
}
