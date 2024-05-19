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
            'day_id' => $dados['day_id'],
        ]);

        $resultEvento->load([
            'room', 'day', 'course',
            'professor:id,pessoa_id,carga_horaria,substitute',
            'professor.pessoa:id,nome,apelido',
            'college_class'
        ]);
        $resultEvento->daysOfWeek = [$resultEvento->day->daysOfWeek];

        $result = [...$resultEvento->toArray(), 'periodo' => $dados['periodo']];
        return $result;
    }

    protected function beforeUpdate(array $inputData, int $id): array
    {
        // if(!isset($inputData['drop'])) {
        // ddFront($inputData);
        $periodoId = CollegeClass::where('period', $inputData['periodo'])->first();
        $inputData['class_id'] = $periodoId['id'];
        // }
        return $inputData;
    }
}
