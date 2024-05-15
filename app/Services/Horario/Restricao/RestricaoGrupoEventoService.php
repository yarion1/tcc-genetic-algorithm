<?php

namespace App\Services\Horario\Restricao;

use App\Models\ModelFront\Scopes\ActiveScope;
use App\Repositories\Horario\Restricao\RestricaoGrupoEventoRepository;
use App\Services\BaseService;

class RestricaoGrupoEventoService extends BaseService
{
    protected $repository;

    public function __construct(RestricaoGrupoEventoRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function afterUpdate(mixed $updatedData, array $inputData): mixed
    {
        $updatedData->daysOfWeek = [$updatedData->daysOfWeek];
        return $updatedData;
    }

    public function getRestricoes(mixed $user)
    {

        if ($user->perfil_id == 2) {
            return $this->repository->find(orderBy: ['id', 'desc'], with: ['classificacao:id,nome', 'restricao'])->get();
        }

        $restricoes = $this->repository->find(orderBy: ['id', 'desc'], with: ['classificacao:id,nome', 'restricao'])->withoutGlobalScope(ActiveScope::class)->get();

        return $restricoes;
    }

    public function excluirRestricoesGrupos(int $id)
    {
        $ids = $this->repository->getModel()->where('tipo_restricao_id', $id)->pluck('id');
        $this->repository->getModel()->where('tipo_restricao_id', $id)->delete();

        return $ids;
    }

    public function acaoAtivacao(int $id, bool $ativo, bool $grupo)
    {
        $result = [];
        if($grupo) {
            $result = $this->repository->find(with: ['classificacao:id,nome', 'restricao'])->withoutGlobalScope(ActiveScope::class)->where('tipo_restricao_id', $id)->get();

            foreach ($result as $key => $restricao) {
                $restricao->ativo = $ativo;
                $restricao->save();
            }
            
        } else {
            $result = $this->repository->find(with: ['classificacao:id,nome', 'restricao'])->withoutGlobalScope(ActiveScope::class)->findOrFail($id);
            $result->ativo = $ativo;
            $result->save();
        }

        if($grupo) {
            $message = $ativo && $grupo ? 'Grupo de Restrições Habilitado' :  'Grupo de Restrições Desabilitado';
        } else {
            $message = $ativo ? 'Restrição Habilitada' : 'Restrição Desabilitada';
        }
        return response()->json(['message' => $message, 'result' => $result]);
    }
}
