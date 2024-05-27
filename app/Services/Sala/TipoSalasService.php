<?php

namespace App\Services\Sala;

use App\Repositories\Sala\TipoSalasRepository;
use App\Services\BaseService;
use Exception;

class TipoSalasService extends BaseService
{
    protected $repository;

    public function __construct(TipoSalasRepository $repository)
    {
        $this->repository = $repository;
    }
    // protected function afterCreate(mixed $createdData, array $inputData): mixed
    // {
    //     if ($this->repository->findByKey(query: [['nome', $inputData['nome']]])->first()) {
    //         throw new Exception('Já existe um tipo de sala com este nome!');
    //     }

    //     return $inputData;
    // }
    protected function beforeCreate(array $inputData): array
    {
        $exists = $this->repository->findByKey(query: [['nome', $inputData['nome']]]);

        if ($exists) {
            throw new Exception('Já existe um tipo de sala com este nome.');
        }
        
        return $inputData;
    }

    protected function beforeUpdate(array $inputData, int $id): array
    {
        if ($existingRecord = $this->repository->findByKey([['nome', $inputData['nome']], ['id', '!=', $id]])) {
            if ($existingRecord->first()) {
                throw new Exception('Já existe um tipo de sala com este nome!');
            }
        }
        return $inputData;
    }
}
