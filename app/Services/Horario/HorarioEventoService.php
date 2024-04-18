<?php

namespace App\Services\Horario;

use App\Models\Evento;
use App\Models\HorarioEventoSala;
use App\Repositories\Horario\HorarioEventoRepository;
use App\Repositories\Turma\TurmaRepository;
use App\Services\BaseService;
use App\Services\Horario\Restricao\RestricaoService;
use Exception;

class HorarioEventoService extends BaseService
{
    protected $repository, $restricaoService, $turmaRepository;

    public function __construct(HorarioEventoRepository $repository, RestricaoService $restricaoService, TurmaRepository $turmaRepository)
    {
        $this->repository = $repository;
        $this->restricaoService = $restricaoService;
        $this->turmaRepository = $turmaRepository;
    }

    public function verificacaoRestricoes(mixed $dados)
    {
        $result = null;
        if(isset($dados['restricoes'])) {
            foreach ($dados['restricoes'] as $key => $restricao) {
                if ($dados['startTime'] >= $restricao['startTime'] && $dados['endTime'] <= $restricao['endTime']) {
                    if($restricao['classificacao_id'] == 1) {
                        $result = $this->verificarTiposRestricoes($restricao, $dados);
                    }
                    if($restricao['classificacao_id'] == 2) {
                        $result = $this->verificarTiposRestricoes($restricao, $dados, true);
                    }
                }  
            }
        } 
        return $result;
    }

    private function verificarTiposRestricoes(array $restricao, array $dados, bool $reallySoft = false)
    {
        $result = null;

        if($restricao['tipo_restricao_id'] == 1) {
           $result = $this->verificarSalas($restricao['salas'], $dados['sala_id'], $dados['turma_id'], $reallySoft);
        }
        return $result;
    }

    private function verificarSalas(array $salas, int $sala_id, int $turma_id, bool $reallySoft = false)
    {
        $turma = $this->turmaRepository->find()->where('id', $turma_id)->firstOrFail();
        $message = null;

        foreach ($salas as $sala) {
            if ($sala['sala_id'] == $sala_id && $sala['sala']['capacidade'] <= $turma->quantidade_alunos) {
               $message = 'Quantidade de alunos da turma ' . $turma->select_text . ' é maior do que a capacidade máxima da sala ' . $sala['sala']['nome'] . ': ' . $sala['sala']['capacidade'].' Alunos';
               if(!$reallySoft) {
                    throw new Exception($message);
                } else {
                    return $message;
                }
            }
        }
    }
}
