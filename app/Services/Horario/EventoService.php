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
            'class_id' => $dados['periodo'],
            'title' => $dados['title'],
            'startTime' => $dados['startTime'],
            'endTime' => $dados['endTime'],
            'room_id' => $dados['sala_id'],
            'course_id' => $dados['disciplina_id'],
            'professor_id' => $dados['professor_id'],
            'day_id' => $dados['daysOfWeek'][0],
        ]);

        $resultEvento->load(['room']);
        $result = [...$resultEvento->toArray(), 'periodo' => $resultHorarioEvento->periodo];
        return $result;
    }
}
