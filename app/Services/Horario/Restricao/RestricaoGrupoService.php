<?php

namespace App\Services\Horario\Restricao;

use App\Models\RestricaoGrupo;
use App\Models\RestricaoGrupoDisciplina;
use App\Models\RestricaoGrupoEvento;
use App\Models\RestricaoGrupoEventoDia;
use App\Models\RestricaoGrupoSala;
use App\Models\Scopes\ActiveScope;
use App\Repositories\Horario\Restricao\RestricaoGrupoRepository;
use App\Repositories\Horario\Restricao\RestricaoRepository;
use App\Services\BaseService;
use Exception;

class RestricaoGrupoService extends BaseService
{
    protected $repository, $restricaoRepository;

    public function __construct(RestricaoGrupoRepository $repository, RestricaoRepository $restricaoRepository)
    {
        $this->repository = $repository;
        $this->restricaoRepository = $restricaoRepository;
    }

    public function createGrupoRestricao(mixed $dados)
    {

        foreach ($dados['events'] as $evento) {
            $resultGrupoRestricao = $this->repository->getModel()->where('restricao_id', $dados['restricao_id'])->where('periodo', $evento['periodo'])->firstOrFail();
            $resultEvento = RestricaoGrupoEvento::create([
                'restricao_grupo_id' => $resultGrupoRestricao->id,
                'tipo_restricao_id' => $evento['tipo_restricao_id'],
                'title' => $evento['title'],
                'classificacao_id' => $evento['classificacao_id'],
                'startTime' => $evento['startTime'],
                'endTime' => $evento['endTime'],
                'daysOfWeek' => $evento['daysOfWeek'][0]
            ]);
            // ddFront($evento['salas']);
            if(isset($evento['salas'])) {
                foreach ($evento['salas'] as $salaId) {
                    RestricaoGrupoSala::create([
                        'restricao_grupo_evento_id' =>  $resultEvento->id,
                        'sala_id' => $salaId,
                    ]);
                }
            }

            if(isset($evento['disciplinas'])) {
                foreach ($evento['disciplinas'] as $disciplinaId) {
                    RestricaoGrupoDisciplina::create([
                        'restricao_grupo_evento_id' =>  $resultEvento->id,
                        'disciplina_id' => $disciplinaId,
                    ]);
                }
            }
        }
        
        $resultGrupoRestricao->load(['events', 'events.salas', 'events.disciplinas']);
        return $resultGrupoRestricao;
    }
}
