<?php

namespace App\Services;

use App\Services\Disciplina\DisciplinaService;
use App\Services\Horario\HorarioService;
use App\Services\Professor\ProfessorService;

class HomeService
{
    protected $horarioService;
    protected $disciplinaService;
    protected $professorService;

    public function __construct(HorarioService $horarioService, DisciplinaService $disciplinaService, ProfessorService $professorService)
    {
        $this->horarioService = $horarioService;
        $this->disciplinaService = $disciplinaService;
        $this->professorService = $professorService;
    }

    public function getDados()
    {
        $countHorarios = $this->horarioService->find()->count();
        $countDisciplinas = $this->disciplinaService->find()->count();
        $countProfessores = $this->professorService->find()->count();
        
        $result = [
            'qtd_horarios' => $countHorarios,
            'qtd_disciplinas' => $countDisciplinas,
            'qtd_professores' => $countProfessores,
        ];

        return $result;
    }
}
