<?php

namespace App\Http\Controllers\Horario\Restricao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\Restricao\RestricaoGrupoRequest;
use App\Services\Horario\Restricao\RestricaoGrupoService;
use Illuminate\Http\Request;

class RestricaoGrupoController extends Controller
{
    protected $service;

    public function __construct(RestricaoGrupoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find()->get());
    }


    public function store(RestricaoGrupoRequest $request)
    {
        $validated = $request->all();
        $this->service->createGrupoRestricao($validated);
        return response()->json(['message' => 'Registro Cadastrado.']);
    }


    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(RestricaoGrupoRequest $request, int $id)
    {
        $validated = $request->all();
        $this->service->update($id, $validated);
        return response()->json(['message' => 'Registro Atualizado.']);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
