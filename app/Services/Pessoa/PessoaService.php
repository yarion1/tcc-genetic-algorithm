<?php

namespace App\Services\Pessoa;

use App\Exceptions\AppError;
use App\Repositories\Pessoa\PessoaRepository;
use App\Services\BaseService;
use Exception;

class PessoaService extends BaseService
{
    protected $repository;

    public function __construct(PessoaRepository $repository)
    {
        $this->repository = $repository;
    }

    private function verificarCpf(string $cpf)
    {
        if (!$this->validarCpf($cpf)) {
            throw new AppError('CPF Inválido');
        }
    }

    protected function beforeCreate(array $inputData): array
    {
        $this->verificarCpf($inputData['cpf']);

        if ($inputData['cpf'] && $this->repository->findByKey(query: [['cpf', $inputData['cpf']]])->first()) {
            throw new AppError('CPF já cadastrado');
        }

        if ($inputData['email'] && $this->repository->findByKey(query: [['email', $inputData['email']]])->first()) {
            throw new AppError('Email já cadastrado');
        }

        return $inputData;
    }

    protected function beforeUpdate(array $inputData, int $id): array
    {
        
        if ($existingRecord = $this->repository->findByKey([['cpf', $inputData['cpf']], ['id', '!=', $id]])) {
            if ($existingRecord->first()) {
                throw new Exception('CPF já cadastrado.');
            }
        }
        
        if (isset($inputData['email']) && $inputData['email']) {
            if ($existingRecord = $this->repository->findByKey([['email', $inputData['email']], ['id', '!=', $id]])) {
                if ($existingRecord->first()) {
                    throw new Exception('Email já cadastrado.');
                }
            }
        }
        
        return $inputData;
    }

    function regexNumeros(string $value = null): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public function alterarMeusDados(int $id, array $dados)
    {
        $this->verificarCpf($dados['cpf']);

        $existingUser = $this->repository->findByKey(query: [['email', $dados['email']], ['id', '!=', $id]]);

        if (isset($dados['email']) && $dados['email'] && $existingUser && $existingUser->first()) {
            throw new Exception('Email já cadastrado.');
        }
        
        unset($dados['cpf']);
        return $this->repository->update($id, $dados);
    }
}
