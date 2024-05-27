<?php

namespace App\Http\Controllers\Horario;

use App\Http\Controllers\Controller;
use App\Services\Horario\BusinessHoursService;
use Illuminate\Http\Request;

class BusinessHoursController extends Controller
{
    protected $service;

    public function __construct(BusinessHoursService $service)
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
