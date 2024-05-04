<?php

namespace App\Services\Horario;

use App\Models\ModelFront\Evento;
use App\Models\ModelFront\EventoDia;
use App\Repositories\Horario\EventoRepository;
use App\Repositories\Horario\HorarioRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\App;

class HorarioService extends BaseService
{
    protected $repository;
    protected $eventoRepository;

    public function __construct(HorarioRepository $repository, EventoRepository $eventoRepository)
    {
        $this->repository = $repository;
        $this->eventoRepository = $eventoRepository;
    }

    public function imprimirHorario(int $id)
    {
        $dados = $this->find(with: [
            'horario',
            'horario.room',
            'horario.college_class',
            'horario.room.tipoSala',
            'horario.course',
            'horario.day',
            'horario.professor:id,pessoa_id',
            'horario.professor.pessoa:id,nome,apelido'
        ])->findOrFail($id);

        $dados = $dados->toArray();
        $events = [];

        for ($i = 1; $i <= 8; $i++) {
            $events[$i] = [
                'periodo' => $i,
                'events' => [],
            ];
        }

        $groupedEvents = [];

        foreach ($dados['horario'] as $horario) {
            $period = $horario['college_class']['period'];
            $startTime = $horario['startTime'];
            $endTime = $horario['endTime'];
            $daysOfWeek = $horario['day']['daysOfWeek'];
        
            // Verificar se já existe um array com o mesmo intervalo de tempo e daysOfWeek
            $found = false;
            foreach ($groupedEvents as &$group) {
                if ($group['startTime'] === $startTime &&
                    $group['endTime'] === $endTime &&
                    in_array($daysOfWeek, $group['daysOfWeek'])) {
                    // Adicionar o evento ao array existente
                    $group['events'][] = $horario;
                    $found = true;
                    break;
                }
            }
        
            // Se não encontrou um array existente, criar um novo
            if (!$found) {
                $groupedEvents[] = [
                    'period' => $period,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'daysOfWeek' => [$daysOfWeek],
                    'events' => [$horario],
                ];
            }
        }
        

        $dados['horario'] = $events;
        ddFront($groupedEvents);
        $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('templateHorario.horario', ['dados' => $dados],)->stream('horario.pdf');
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

        $resultHorario->load(['horario']);

        return $resultHorario;
    }

    public function findHorario(int $id)
    {
        $result = $this->find(with: [
            'horario',
            // 'college_class',
            'horario.college_class',
            'horario.room',
            'horario.room.tipoSala',
            'horario.course',
            'horario.professor:id,pessoa_id',
            'horario.professor.pessoa:id,nome,apelido',
            'horario.day',
        ])->findOrFail($id);
        // $result->horario->flatMap(function ($horario) {
        //     return $horario->events;
        // })->each(function ($evento) {
        //     $evento->daysOfWeek = $evento->eventoDias->pluck('daysOfWeek')->toArray();
        // });


        $result->horario->transform(function ($evt) {
            $evt->daysOfWeek = [$evt->day->daysOfWeek];
            unset($evt->day);

            return $evt;
        });

        return $result;
    }
}
