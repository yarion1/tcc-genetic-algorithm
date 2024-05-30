<?php

namespace App\Services\Horario;

use App\Repositories\Horario\EventoRepository;
use App\Services\BaseService;
use App\Models\CollegeClass;
use App\Models\Timetable;
use App\Repositories\Pessoa\PessoaRepository;

class EventoService extends BaseService
{
    protected $repository;
    protected $pessoaRepository;

    public function __construct(EventoRepository $repository, PessoaRepository $pessoaRepository)
    {
        $this->repository = $repository;
        $this->pessoaRepository = $pessoaRepository;
    }

    public function createEventoHorario(mixed $dados)
    {
        // $resultHorarioEvento = $this->horarioEventoRepository->getModel()->where('horario_id', $dados['horario_id'])->where('periodo', $dados['periodo'])->firstOrFail();
        $periodoId = CollegeClass::where('period', $dados['periodo'])->first();
        $coordernador =  $this->pessoaRepository->find()->where('perfil_id', 1)->where('curso_id', 1)->firstOrFail();

        $timetable = Timetable::create([
            'user_id' => $coordernador['id'],
            'academic_period_id' => 1,
            'status' => 'IN PROGRESS',
            'name' => $dados['descricao'],
            'horario_id' => (int)$dados['horario_id']
        ]);

        $resultEvento = $this->repository->create([
            'timetable_id' => $timetable->id,
            'title' => $dados['title'],
            'startTime' => $dados['startTime'],
            'endTime' => $dados['endTime'],
            'horario_id' => (int)$dados['horario_id'],
            'timeslot_id' => (int)$dados['timeslot_id'],
            'class_id' => (int)$periodoId['id'],
            'room_id' => (int)$dados['room_id'],
            'course_id' => (int)$dados['course_id'],
            'professor_id' => (int)$dados['professor_id'],
            'day_id' => (int)$dados['day_id'],

        ]);

        $resultEvento->load([
            'room', 'day', 'course',
            'room.tipoSala',
            'professor:id,pessoa_id,carga_horaria,substitute',
            'professor.pessoa:id,nome,apelido',
            'professor.unavailable_timeslots',
            'professor.unavailable_timeslots.day:id,daysOfWeek,name',
            'professor.unavailable_timeslots.timeslot:id,startTime,endTime,time',
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
