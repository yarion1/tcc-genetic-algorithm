<?php

namespace App\Http\Controllers\Horario\Restricao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\Restricao\RestricaoRequest;
use App\Models\Scopes\ActiveScope;
use App\Services\Horario\Restricao\RestricaoService;
use Illuminate\Http\Request;

class RestricaoController extends Controller
{
    protected $service;

    public function __construct(RestricaoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $result = $this->service->findRestricao(null);
        return response()->json($result);
    }

    public function store(RestricaoRequest $request)
    {
        $validated = $request->all();
        $this->service->createRestricoes($validated);
        return response()->json(['message' => 'Registro Cadastrado.']);
    }


    public function show(int $id)
    {
        $result = $this->service->findRestricao($id);
        return response()->json($result);
    }

    public function update(RestricaoRequest $request, int $id)
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
