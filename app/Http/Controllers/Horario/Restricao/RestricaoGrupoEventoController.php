<?php

namespace App\Http\Controllers\Horario\Restricao;

use App\Http\Controllers\Controller;
use App\Models\ModelFront\Scopes\ActiveScope;
use App\Services\Horario\Restricao\RestricaoGrupoEventoService;
use Illuminate\Http\Request;

class RestricaoGrupoEventoController extends Controller
{
    protected $service;

    public function __construct(RestricaoGrupoEventoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find(with:['classificacao:id,nome,cor_destaque', 'restricao', 'salas', 'salas.tipoSala:id,nome', 'disciplinas', 'disciplinas.disciplina:id,name'])->get());
    }


    public function store(Request $request)
    {
        $validated = $request->all();
        $this->service->create($validated);
        return response()->json(['message' => 'Registro Cadastrado.']);
    }


    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function geral()
    {
        $user = auth()->user();
        $result = $this->service->getRestricoes($user);
        return response()->json($result);
    }

    public function acaoAtivacao(Request $request, int $id)
    {
       $request = $request->all();
       $result =  $this->service->acaoAtivacao($id, $request['ativo'], $request['grupo']);  
       return $result;
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->all();
        $result = $this->service->update($id, $validated, ['sala_id' => 'salas', 'disciplina_id' => 'disciplinas']);
        $result->load(['disciplinas', 'salas']);
        return response()->json(['message' => 'Registro Atualizado.', 'result' => $result]);
    }


    public function destroyGrupo(int $id)
    {
        $ids = $this->service->excluirRestricoesGrupos($id);
        return response()->json(['message' => 'Registro Excluído.', 'ids' => $ids]);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
