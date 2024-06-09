<?php

namespace App\Http\Controllers\Sala;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sala\SalaRequest;
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


    public function store(SalaRequest $request)
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
        $result = $this->service->advancedUpdate($id, $validated, ['tipoSala']);
        $result->load('tipoSala:id,nome');
        return response()->json(['message' => 'Registro Atualizado.', 'result' => $result]);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id, ['schedules']);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
