<?php

namespace App\Services\Professor;

use App\Models\ModelFront\DisciplinasProfessores;
use App\Models\ModelFront\DisponibilidadesProfessores;
use App\Models\ModelFront\PrioridadesProfessores;
use App\Repositories\Professor\ProfessorRepository;
use App\Services\BaseService;
use App\Services\Pessoa\PessoaService;

class ProfessorService extends BaseService
{
    protected $repository;
    protected $pessoaService;

    public function __construct(ProfessorRepository $repository, PessoaService $pessoaService)
    {
        $this->repository = $repository;
        $this->pessoaService = $pessoaService;
    }

    public function criarProfessor(array $inputData): array
    {
        $inputData['perfil_id'] = 2;
        $pessoa = $this->pessoaService->advancedCreate($inputData);
        $professor = $this->repository->create([
            'pessoa_id' => $pessoa['id'],
            'carga_horaria' => $inputData['carga_horaria']
        ]);

        foreach ($inputData['disciplinas'] as $disciplinaId) {
            DisciplinasProfessores::create(
                [
                    'professor_id' => $professor['id'],
                    'disciplina_id' => $disciplinaId
                ]
            );
        }
        
        foreach ($inputData['prioridades'] as $prioridadeId){
            PrioridadesProfessores::create(
                [
                    'professor_id' => $professor['id'],
                    'prioridade_id' => $prioridadeId
                    ]
                );
            }
            
            foreach ($inputData['disponibilidades'] as $disponibilidadeId){
                DisponibilidadesProfessores::create(
                    [
                    'professor_id' => $professor['id'],
                    'disponibilidade_id' => $disponibilidadeId
                ]
            );
        }

        return $inputData;
    }

    protected function beforeUpdate(array $inputData, int $id): array
    {
        DisciplinasProfessores::where('professor_id', $id)->delete();
        PrioridadesProfessores::where('professor_id', $id)->delete();
        DisponibilidadesProfessores::where('professor_id', $id)->delete();

        foreach ($inputData['disciplinas'] as $disciplinaId) {
            DisciplinasProfessores::updateOrCreate(
                [
                    'professor_id' => $id,
                    'disciplina_id' => $disciplinaId
                ]
            );
        }

        foreach ($inputData['prioridades'] as $prioridadeId){
            PrioridadesProfessores::updateOrCreate(
                [
                    'professor_id' => $id,
                    'prioridade_id' => $prioridadeId
                    ]
                );
            }
            
            foreach ($inputData['disponibilidades'] as $disponibilidadeId){
                DisponibilidadesProfessores::updateOrCreate(
                    [
                    'professor_id' => $id,
                    'disponibilidade_id' => $disponibilidadeId
                ]
            );
        }

        return $inputData;
    }
}
