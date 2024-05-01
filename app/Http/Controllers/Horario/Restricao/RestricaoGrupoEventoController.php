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
        return response()->json($this->service->find(with:['classificacao:id,nome,cor_destaque', 'restricao', 'salas', 'salas.tipoSala:id,nome', 'disciplinas', 'disciplinas.disciplina:id,nome'])->get());
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
        if($user->perfil_id == 2) {
            return response()->json($this->service->find(orderBy:['id', 'desc'], with:['classificacao:id,nome', 'restricao'])->get());
        } 
        return response()->json($this->service->find(orderBy:['id', 'desc'], with:['classificacao:id,nome', 'restricao'])->withoutGlobalScope(ActiveScope::class)->get());
    }

    public function acaoAtivacao(Request $request, int $id)
    {
       $request = $request->all();
       $result =  $this->service->acaoAtivacao($id, $request['ativo']);  
       return $result;
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->all();
        $result = $this->service->update($id, $validated, ['sala_id' => 'salas', 'disciplina_id' => 'disciplinas']);
        return response()->json(['message' => 'Registro Atualizado.', 'result' => $result]);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
