<?php

namespace App\Http\Controllers\Horario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\HorarioEventoRequest;
use App\Services\Horario\HorarioEventoService;
use Illuminate\Http\Request;

class HorarioEventoController extends Controller
{
    protected $service;

    public function __construct(HorarioEventoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find()->get());
    }

    // public function verificacaoRestricoes(HorarioEventoRequest $request)
    // {
    //     $validated = $request->all();
    //     $result = $this->service->verificacaoRestricoes($validated);
    //     return response()->json(['result' => $result]);
    // }

    public function store(HorarioEventoRequest $request)
    {
        $validated = $request->all();
        $result = $this->service->create($validated);
        return response()->json(['message' => 'Registro Cadastrado.', 'result' => $result]);
    }


    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(HorarioEventoRequest $request, int $id)
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
