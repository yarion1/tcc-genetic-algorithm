<?php

namespace App\Services\Horario\Restricao;

use App\Models\ModelFront\RestricaoGrupo;
use App\Models\ModelFront\Scopes\ActiveScope;
use App\Repositories\Horario\Restricao\RestricaoRepository;
use App\Services\BaseService;
use Exception;

class RestricaoService extends BaseService
{
    protected $repository;

    public function __construct(RestricaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createRestricoes(mixed $dados)
    {
        $resultRestricao = $this->repository->create($dados);


        for ($i = 1; $i <= 8; $i++) {
            RestricaoGrupo::create([
                'periodo' => $i,
                'restricao_id' => $resultRestricao->id,
            ]);
        }

        $resultRestricao->load(['restricao', 'restricao.events', 'restricao.events.eventoDias']);

        return $resultRestricao;
    }

    public function findRestricao(int $id)
    {
        $result = $this->repository->find(with: ['restricao', 'restricao.events',  'restricao.events.salas', 'restricao.events.disciplinas', 'restricao.events.salas', 'restricao.events.disciplinas'])->findOrFail($id);;

        $result->restricao->transform(function ($restricao) {
            $restricao->events->transform(function ($evt) {
                $evt->daysOfWeek = [$evt->daysOfWeek];
                return $evt;
            });
            return $restricao;
        });

        return $result;
    }
}
