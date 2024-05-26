<?php

namespace App\Services\Professor;

use App\Models\CoursesProfessor;
use App\Models\ModelFront\DisponibilidadesProfessores;
use App\Models\ModelFront\PrioridadesProfessores;
use App\Models\UnavailableTimeslot;
use App\Repositories\Professor\ProfessorRepository;
use App\Repositories\UnavailableTimeslotRepository;
use App\Services\BaseService;
use App\Services\Pessoa\PessoaService;

class ProfessorService extends BaseService
{
    protected $repository;
    protected $pessoaService;
    protected $unavailableTimeslotRepository;

    public function __construct(ProfessorRepository $repository, PessoaService $pessoaService, UnavailableTimeslotRepository $unavailableTimeslotRepository)
    {
        $this->repository = $repository;
        $this->pessoaService = $pessoaService;
        $this->unavailableTimeslotRepository = $unavailableTimeslotRepository;
    }

    public function criarProfessor(array $inputData): array
    {
        $inputData['perfil_id'] = 1;
        $pessoa = $this->pessoaService->advancedCreate($inputData['pessoa']);
        $professor = $this->repository->create([
            'pessoa_id' => $pessoa['id'],
            'name' => $pessoa['nome'],
            'email' => $pessoa['email'],
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

        if (isset($inputData['unavailable_timeslots'])) {
            foreach ($inputData['unavailable_timeslots'] as $time) {
                $time['professor_id'] = $professor['id'];
                $this->unavailableTimeslotRepository->create($time);
            }
        }
        
        return $inputData;
    }
    
    protected function beforeUpdate(array $inputData, int $id): array
    {
        if (isset($inputData['pessoa'])) {
            if ($inputData['pessoa_id'] == null) {
                $pessoa = $this->pessoaService->advancedCreate($inputData['pessoa']);
                $inputData['pessoa_id'] = $pessoa->id;
            } else {
                $this->pessoaService->update($inputData['pessoa_id'], $inputData['pessoa']);
            }
        }

        $currentCourses = CoursesProfessor::where('professor_id', $id)
            ->pluck('course_id')
            ->toArray();
        $coursesToRemove = array_diff($currentCourses, $inputData['courses']);

        CoursesProfessor::where('professor_id', $id)
            ->whereIn('course_id', $coursesToRemove)
            ->delete();

        $coursesToAdd = array_diff($inputData['courses'], $currentCourses);
        foreach ($coursesToAdd as $disciplinaId) {
            CoursesProfessor::updateOrCreate(
                [
                    'professor_id' => $id,
                    'course_id' => $disciplinaId
                ]
            );
        }

        if (isset($inputData['unavailable_timeslots'])) {
            foreach ($inputData['unavailable_timeslots'] as $time) {
                if (isset($time['id'])) {
                    $this->unavailableTimeslotRepository->update($time['id'], $time);
                } else {
                    $time['professor_id'] = $id;
                    $this->unavailableTimeslotRepository->create($time);
                }
            }
        }

        return $inputData;
    }

    protected function afterDelete(int $id)
    {
        $professor = $this->repository->find()->findOrFail($id);
        $this->pessoaService->delete($professor['pessoa_id']);
    }
}
