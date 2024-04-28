<?php

namespace App\Services\Horario;

use App\Models\ModelFront\Evento;
use App\Models\ModelFront\EventoDia;
use App\Repositories\Horario\EventoRepository;
use App\Repositories\Horario\HorarioRepository;
use App\Services\BaseService;

class HorarioService extends BaseService
{
    protected $repository;
    protected $eventoRepository;

    public function __construct(HorarioRepository $repository, EventoRepository $eventoRepository)
    {
        $this->repository = $repository;
        $this->eventoRepository = $eventoRepository;
    }

    public function criarHorario(mixed $dados)
    {
        $resultHorario = $this->repository->create($dados);


//        for ($i = 1; $i <= 8; $i++) {
//            HorarioEvento::create([
//                'periodo' => $i,
//                'horario_id' => $resultHorario->id,
//            ]);
//        }

        $resultHorario->load(['horario', 'horario.events']);

        return $resultHorario;
    }

    public function findHorario(int $id)
    {
        $result = $this->find(with: [
            'horario',
            'horario.room',
            'horario.room.tipoSala',
            'horario.course',
            'horario.professor:id',
            'horario.professor.pessoa:id,nome,apelido'
        ])->findOrFail($id);
        // $result->horario->flatMap(function ($horario) {
        //     return $horario->events;
        // })->each(function ($evento) {
        //     $evento->daysOfWeek = $evento->eventoDias->pluck('daysOfWeek')->toArray();
        // });


        $result->horario->transform(function ($evt) {
            $evt->daysOfWeek = [$evt->day_id];
            unset($evt->day_id);

            return $evt;
        });

        return $result;
    }
}
