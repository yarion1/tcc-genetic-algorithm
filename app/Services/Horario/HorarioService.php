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
        $newArray = [];

        $newArray = array();
        $groupedEvents = array();
        
        foreach ($dados['horario'] as $horario) {
            $period = $horario['college_class']['period'];
            $daysOfWeek = $horario['day']['daysOfWeek'];
            unset($horario['day']);
        
            // Verifica se o grupo de eventos para este dia já existe
            if (!isset($groupedEvents[$daysOfWeek])) {
                // Se não existir, cria um novo grupo de eventos
                $groupedEvents[$daysOfWeek] = array(
                    'daysOfWeek' => $daysOfWeek,
                    'events' => array()
                );
            }
        
            // Adiciona o evento ao grupo de eventos correspondente ao dia da semana
            $groupedEvents[$daysOfWeek]['events'][] = $horario;
        
            // Verifica se todos os grupos de eventos já foram preenchidos
            $allHaveEventId = true;
            foreach ($groupedEvents as $event) {
                if (empty($event['events'])) {
                    $allHaveEventId = false;
                    break;
                }
            }
        
            // Se todos os grupos de eventos estiverem preenchidos, adiciona ao newArray
            if ($allHaveEventId) {
                $newArray[] = $groupedEvents;
                $groupedEvents = array(); // Limpa o array para iniciar um novo conjunto
            }
        }
        
        ddFront($newArray);
        


        $dados['horario'] = $events;
        ddFront($events);
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
