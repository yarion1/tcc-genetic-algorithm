<?php

namespace App\Services\Professor;

use App\Models\CoursesProfessor;
use App\Models\ModelFront\DisponibilidadesProfessores;
use App\Models\ModelFront\PrioridadesProfessores;
use App\Models\UnavailableTimeslot;
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
        $inputData['perfil_id'] = 1;
        $pessoa = $this->pessoaService->advancedCreate($inputData['pessoa']);
        $professor = $this->repository->create([
            'pessoa_id' => $pessoa['id'],
            'name' => $inputData['nome'],
            'email' => $inputData['email'],
            'carga_horaria' => $inputData['carga_horaria']
        ]);

        foreach ($inputData['courses'] as $disciplinaId) {
            CoursesProfessor::create(
                [
                    'professor_id' => $professor['id'],
                    'course_id' => $disciplinaId
                ]
            );
        }

        foreach ($inputData['times'] as $time){
            UnavailableTimeslot::create(
                [
                    'professor_id' => $professor['id'],
                    'day_id' => $time['day_id'],
                    'timeslot_id' => $time['timeslot_id']
                    ]
                );
            }

        return $inputData;
    }

    protected function beforeUpdate(array $inputData, int $id): array
    {
        // CoursesProfessor::where('professor_id', $id)->delete();
        // PrioridadesProfessores::where('professor_id', $id)->delete();
        // DisponibilidadesProfessores::where('professor_id', $id)->delete();
        if(isset($inputData['pessoa'])) {
            $this->pessoaService->update($inputData['pessoa_id'], $inputData['pessoa']);
        }
      
        foreach ($inputData['courses'] as $disciplinaId) {
            CoursesProfessor::updateOrCreate(
                [
                    'professor_id' => $id,
                    'course_id' => $disciplinaId
                ]
            );
        }

        if(isset($inputData['times'])) {
            foreach ($inputData['times'] as $time){
                UnavailableTimeslot::updateOrCreate(
                    [
                        'professor_id' => $id,
                        'day_id' => $time['day_id'],
                        'timeslot_id' => $time['timeslot_id']
                        ]
                    );
                }
        }

        return $inputData;
    }
}
