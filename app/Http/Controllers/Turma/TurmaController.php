<?php

namespace App\Http\Controllers\Turma;

use App\Http\Controllers\Controller;
use App\Services\Turma\TurmaService;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    protected $service;

    public function __construct(TurmaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find()->get());
    }


    public function store(Request $request)
    {
        $validated = $request->all();
        $result = $this->service->create($validated);
        return response()->json(['message' => 'Registro Cadastrado.', "result" => $result]);
    }


    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->all();
        $result = $this->service->update($id, $validated);
        return response()->json(['message' => 'Registro Atualizado.', 'result' => $result]);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
