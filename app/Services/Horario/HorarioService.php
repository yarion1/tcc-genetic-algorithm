<?php

namespace App\Services\Horario;

use App\Models\ModelFront\Evento;
use App\Models\ModelFront\EventoDia;
use App\Models\ModelFront\HorarioEvento;
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


        for ($i = 1; $i <= 8; $i++) {
            HorarioEvento::create([
                'periodo' => $i,
                'horario_id' => $resultHorario->id,
            ]);
        }

        $resultHorario->load(['horario', 'horario.events']);

        return $resultHorario;
    }

    public function findHorario(int $id)
    {
        $result = $this->find(with: [
            'horario',
            'horario.events',
            'horario.events.sala',
            'horario.events.sala.tipoSala',
            'horario.events.turma',
            'horario.events.disciplina',
            'horario.events.professor:id,pessoa_id,professor_cargo_id',
            'horario.events.professor.pessoa:id,nome,apelido'
        ])->findOrFail($id);
        // $result->horario->flatMap(function ($horario) {
        //     return $horario->events;
        // })->each(function ($evento) {
        //     $evento->daysOfWeek = $evento->eventoDias->pluck('daysOfWeek')->toArray();
        // });

        $result->horario->transform(function ($horario) {
            $horario->events->transform(function ($evt) {
                $evt->daysOfWeek = [$evt->daysOfWeek];
                return $evt;
            });
            return $horario;
        });

        return $result;
    }
}
