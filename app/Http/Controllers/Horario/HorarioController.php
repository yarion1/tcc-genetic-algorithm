<?php

namespace App\Http\Controllers\Horario;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\HorarioRequest;
use App\Services\Horario\HorarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
    protected $service;

    public function __construct(HorarioService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find()->get());
    }


    public function store(HorarioRequest $request)
    {
        $validated = $request->all();
        $result = $this->service->criarHorario($validated);
        return response()->json(['message' => 'Registro Cadastrado.', 'result' => $result]);
    }


    public function show(int $id)
    {
        $result = $this->service->findHorario($id);
        return response()->json($result);
    }

    public function update(HorarioRequest $request, int $id)
    {
        $validated = $request->all();
        $this->service->update($id, $validated);
        return response()->json(['message' => 'Registro Atualizado.']);
    }


    public function destroy(int $id)
    {
        $coordernador = !Auth::user()->perfil_id ?? 1;
        if($coordernador) {
            $this->service->delete($id);
            return response()->json(['message' => 'Registro Excluído.']);
        }
    }

    public function imprimir(int $id)
    {
        $result = $this->service->imprimirHorario($id);
        return $result;
    }
}
