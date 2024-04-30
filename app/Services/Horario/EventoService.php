<?php

namespace App\Services\Horario;

use App\Repositories\Horario\EventoRepository;
use App\Services\BaseService;
use App\Models\CollegeClass;

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

        $periodoId = CollegeClass::where('period', $dados['periodo'])->first();

        $resultEvento = $this->repository->create([
            'horario_id' => $dados['horario_id'],
            'timeslot_id' => $dados['timeslot_id'],
            'timetable_id' =>  85,
            'class_id' => $periodoId['id'],
            'title' => $dados['title'],
            'startTime' => $dados['startTime'],
            'endTime' => $dados['endTime'],
            'room_id' => $dados['room_id'],
            'course_id' => $dados['course_id'],
            'professor_id' => $dados['professor_id'],
            'day_id' => $dados['daysOfWeek'][0],
        ]);

        $resultEvento->load(['room']);
        $result = [...$resultEvento->toArray(), 'periodo' => $dados['periodo']];
        return $result;
    }
}
