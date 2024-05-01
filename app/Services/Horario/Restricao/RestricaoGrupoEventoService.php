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

    public function acaoAtivacao(int $id, bool $ativo)
    {
        $result = $this->repository->find(with: ['classificacao:id,nome', 'restricao'])->withoutGlobalScope(ActiveScope::class)->findOrFail($id);

        $result->ativo = $ativo;
        $result->save();

        $message = $ativo ? 'Restrição Habilitada' : 'Restrição Desabilitada';
        return response()->json(['message' => $message, 'result' => $result]);
    }
}
