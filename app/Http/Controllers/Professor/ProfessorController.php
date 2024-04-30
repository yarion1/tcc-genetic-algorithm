<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\ProfessorRequest;
use App\Services\Professor\ProfessorService;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    protected $service;

    public function __construct(ProfessorService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find(with: ['pessoa:id,nome'])->get());
    }


    public function store(ProfessorRequest $request)
    {
        $validated = $request->all();
        $this->service->criarProfessor($validated);
        return response()->json(['message' => 'Registro Cadastrado.']);
    }


    public function show(int $id)
    {
        // return response()->json($this->service->find(with:['disciplinas', 'disciplinas.disciplina', 'prioridades', 'disponibilidades', 'pessoa'])->findOrFail($id));
        return response()->json($this->service->find(with:['courses', 'pessoa'])->findOrFail($id));
    }

    public function update(ProfessorRequest $request, int $id)
    {
        $validated = $request->all();
        $this->service->update($id, $validated, relations:['pessoa_id' => 'pessoas']);
        return response()->json(['message' => 'Registro Atualizado.']);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id, ['disciplinas', 'prioridades', 'disponibilidades', 'pessoa']);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
