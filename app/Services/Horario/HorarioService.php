<?php

namespace App\Services\Horario;

use App\Models\ModelFront\Evento;
use App\Models\ModelFront\EventoDia;
use App\Models\ModelFront\Scopes\ActiveScope;
use App\Models\Timetable;
use App\Repositories\Horario\EventoRepository;
use App\Repositories\Horario\HorarioRepository;
use App\Repositories\Pessoa\PessoaRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\App;

class HorarioService extends BaseService
{
    protected $repository;
    protected $eventoRepository;
    protected $pessoaRepository;

    public function __construct(HorarioRepository $repository, EventoRepository $eventoRepository, PessoaRepository $pessoaRepository)
    {
        $this->repository = $repository;
        $this->eventoRepository = $eventoRepository;
         $this->pessoaRepository = $pessoaRepository;
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
            'horario.professor:id,pessoa_id,substitute',
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

        foreach ($dados['horario'] as $horario) {
            $period = $horario['college_class']['period'];
            $horario['daysOfWeek'] = $horario['day']['daysOfWeek'];
            unset($horario['day']);

            $events[$period]['events'][] = $horario;
            $events[$period]['daysOfWeek'] = $horario['daysOfWeek'];
        }


        $dados['horario'] = $events;
        // ddFront($dados['horario']);

        $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('templateHorario.horario', ['dados' => $dados['horario']],)->setPaper('A4', 'landscape')->stream('horario.pdf');
    }

    private function gerarCodigoVersao($versaoOrigem = null, $versaoId = null)
    {
        if(!isset($versaoOrigem)) {
            $versao = $this->repository->getModel()->where('versao', 'like', '%.0')->pluck('versao')->last();
         
            if (!isset($versao)) {
                return "1.0";
            }

            $versao = explode('.', $versao);
            $firstDigit = intval($versao[0]) + 1;
            
            $versao = "$firstDigit.0";

            return $versao;
        } 

        $ultimoDigitoPai = intval(substr($versaoOrigem, -1));
        
        $ultimaVersaoCopia = $this->repository->getModel()->where('chave_pai', $versaoId)->pluck('versao')->first();
        $ultimaVersaoCopia = explode('.', $ultimaVersaoCopia);
        $ultimoDigitoCopia = !$ultimaVersaoCopia ? 0 : intval($ultimaVersaoCopia[count($ultimaVersaoCopia) - 1]);
        $ultimoDigitoCopia++;

        $resto = substr($versaoOrigem, 0, $ultimoDigitoPai == 0 ? strlen($versaoOrigem) - 2 : strlen($versaoOrigem));
        
        $versao = "$resto.$ultimoDigitoCopia";
        
        return $versao;
    }
    

    public function criarHorario(array $dados, bool $copia = false)
    {
        $versaoOrigem = $dados['versao'] ?? null;
        $versaoId = $dados['id'] ?? null;

        $versao = $this->gerarCodigoVersao($versaoOrigem, $versaoId);

        $dados['versao'] = $versao;

        if ($copia) {
            $dados['chave_pai'] = $dados['id'];
            unset($dados['id']);
        }

        $resultHorario = $this->repository->create($dados);
        $coordernador =  $this->pessoaRepository->find()->where('perfil_id', 1)->where('curso_id', 1)->firstOrFail();

        if (isset($dados['horario'])) {
            foreach ($dados['horario'] as $key => $horario) {
                unset($horario['id']);
                $timetable = Timetable::create([
                    'user_id' => $coordernador['id'],
                    'academic_period_id' => 1,
                    'status' => 'IN PROGRESS',
                    'name' => $dados['descricao'],
                    'horario_id' => $resultHorario->id
                ]);


                $this->eventoRepository->create([
                    'horario_id' => $resultHorario->id,
                    'timeslot_id' => $horario['timeslot_id'],
                    'timetable_id' =>  $timetable->id,
                    'class_id' => $horario['class_id'],
                    'title' => $horario['title'],
                    'startTime' => $horario['startTime'],
                    'endTime' => $horario['endTime'],
                    'room_id' => $horario['room_id'],
                    'course_id' => $horario['course_id'],
                    'professor_id' => $horario['professor_id'],
                    'day_id' => $horario['day_id'],
                ]);
            }
        }

        $resultHorario->load(['horario']);

        return $resultHorario;
    }

    public function ativarVersao(int $id, bool $ativo)
    {
        $horarioAtivo = !!$this->repository->getModel()->where('versao_atual', true)->first();

        if ($horarioAtivo && $ativo) {
            throw new Exception("Já existe um horário ativado como versão final.");
        }

        $result = $this->repository->find()->withoutGlobalScope(ActiveScope::class)->findOrFail($id);

        $result->versao_atual = $ativo;
        $result->load('usuarioCadastro');
        $result->update();

        $message = $ativo ? 'Versão do Horário Ativada' : 'Versão do Horário Desativada';
        return response()->json(['message' => $message, 'result' => $result]);
    }

    public function updateGeracao(int $id, bool $gerando)
    {
        $result = $this->repository->find()->findOrFail($id);

        $result->gerando = $gerando;
        $result->update();
    }

    public function criarCopia(int $id)
    {
        $horarioAtual = $this->repository->find(with: ['horario'])->findOrFail($id);
        unset($horarioAtual['versao_atual']);
        unset($horarioAtual['gerando']);
        $result = $this->criarHorario($horarioAtual->toArray(), true);
        return $result;
    }

    public function findHorario(int $id)
    {
        $result = $this->find(with: [
            'horario',
            'horario.college_class',
            'horario.room',
            'horario.room.tipoSala',
            'horario.course',
            'horario.professor:id,pessoa_id,carga_horaria,substitute',
            'horario.professor.pessoa:id,nome,apelido',
            'horario.professor.unavailable_timeslots',
            'horario.professor.unavailable_timeslots.day:id,daysOfWeek,name',
            'horario.professor.unavailable_timeslots.timeslot:id,startTime,endTime,time',
            'horario.day',
            'usuarioCadastro',
        ])->findOrFail($id);

        $result->horario->transform(function ($evt) {
            $evt->daysOfWeek = [$evt->day->daysOfWeek];
            unset($evt->day);

            return $evt;
        });

        return $result;
    }
}
