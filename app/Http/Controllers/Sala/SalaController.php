<?php

namespace App\Http\Controllers\Sala;

use App\Http\Controllers\Controller;
use App\Services\Sala\SalaService;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    protected $service;

    public function __construct(SalaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find(with: ['tipoSala:id,nome'])->get());
    }


    public function store(Request $request)
    {
        $validated = $request->all();
        $result = $this->service->create($validated);
        return response()->json(['message' => 'Registro Cadastrado.', 'result' => $result->load(['tipoSala:id,nome'])]);
    }


    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->all();
        $this->service->advancedUpdate($id, $validated);
        return response()->json(['message' => 'Registro Atualizado.']);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
