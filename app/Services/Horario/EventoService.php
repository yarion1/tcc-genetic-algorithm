<?php

namespace App\Services\Horario;

use App\Repositories\Horario\EventoRepository;
use App\Services\BaseService;

class EventoService extends BaseService
{
    protected $repository;

    public function __construct(EventoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createEventoHorario(mixed $dados)
    {
        // $resultHorarioEvento = $this->horarioEventoRepository->getModel()->where('horario_id', $dados['horario_id'])->where('periodo', $dados['periodo'])->firstOrFail();

        $resultEvento = $this->repository->create([
            'periodo_id' => $dados['periodo'],
            'title' => $dados['title'],
            'startTime' => $dados['startTime'],
            'endTime' => $dados['endTime'],
            'sala_id' => $dados['sala_id'],
            'turma_id' => $dados['turma_id'],
            'disciplina_id' => $dados['disciplina_id'],
            'professor_id' => $dados['professor_id'],
            'daysOfWeek' => $dados['daysOfWeek'][0],
        ]);

        $resultEvento->load(['sala', 'turma']);
        $result = [...$resultEvento->toArray(), 'periodo' => $resultHorarioEvento->periodo];
        return $result;
    }
}
