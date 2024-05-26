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
        return response()->json($this->service->find(with: ['pessoa:id,nome', 'courses:id,name,course_code', 'unavailable_timeslots'], orderBy: ['id', 'desc'])->get());
    }


    public function store(ProfessorRequest $request)
    {
        $validated = $request->all();
        $this->service->criarProfessor($validated);
        return response()->json(['message' => 'Registro Cadastrado.']);
    }

    public function showPessoaProfessor(int $id)
    {
        $result = $this->service->find(with:['courses', 'pessoa', 'unavailable_timeslots'])->where('pessoa_id', $id)->firstOrFail();
        $result['cpf'] = $result['pessoa']['cpf'];
        $result['telefone'] = $result['pessoa']['telefone'];
        $result['apelido'] = $result['pessoa']['apelido'];
        $result['perfil_id'] = $result['pessoa']['perfil_id'];
        $result['curso_id'] = $result['pessoa']['curso_id'];
        $result['nome'] = $result['pessoa']['nome'];
        return response()->json($result);
    }

    public function show(int $id)
    {
        // return response()->json($this->service->find(with:['disciplinas', 'disciplinas.disciplina', 'prioridades', 'disponibilidades', 'pessoa'])->findOrFail($id));
        return response()->json($this->service->find(with:['courses', 'pessoa', 'unavailable_timeslots'])->findOrFail($id));
    }

    public function update(ProfessorRequest $request, int $id)
    {
        $validated = $request->all();
        $this->service->update($id, $validated, relations:['pessoa_id' => 'pessoas']);
        return response()->json(['message' => 'Registro Atualizado.']);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id, ['schedule']);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
