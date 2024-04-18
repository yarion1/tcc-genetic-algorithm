<?php

namespace App\Http\Controllers\Sala;

use App\Http\Controllers\Controller;
use App\Services\Sala\TipoSalasService;
use Illuminate\Http\Request;

class TipoSalasController extends Controller
{
    protected $service;

    public function __construct(TipoSalasService $service)
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
        $this->service->update($id, $validated);
        return response()->json(['message' => 'Registro Atualizado.']);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
