<?php

namespace App\Http\Controllers\Horario\Restricao;

use App\Http\Controllers\Controller;
use App\Services\Horario\Restricao\TipoRestricaoService;
use Illuminate\Http\Request;

class TipoRestricaoController extends Controller
{
    protected $service;

    public function __construct(TipoRestricaoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find(orderBy:['id', 'asc'])->get());
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

    public function update(Request $request, int $id)
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
