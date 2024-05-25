<?php

namespace App\Http\Controllers\Disciplina;

use App\Http\Controllers\Controller;
use App\Http\Requests\Disciplina\DisciplinaRequest;
use App\Services\Disciplina\DisciplinaService;
use Illuminate\Support\Facades\Auth;

class DisciplinaController extends Controller
{

    protected $service;

    public function __construct(DisciplinaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find(with: ['collegeClass:id,name,period'], orderBy: ['college_class_id', 'asc'])->get());
    }

    public function store(DisciplinaRequest $request)
    {
        $coordenador_id = Auth::id();

        $validated = $request->validated();
    
        $validated['coordenador_id'] = $coordenador_id;
        $result = $this->service->advancedCreate($validated);
        return response()->json(['message' => 'Diciplina Cadastrada.', 'result' => $result]);
    }

    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(DisciplinaRequest $request, int $id)
    {
        $validated = $request->validated();
        $result = $this->service->advancedUpdate($id, $validated, ['collegeClass']);
        $result->load('collegeClass:id,name,period');
        return response()->json(['message' => 'Diciplina Atualizada.', 'result' => $result]);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Diciplina Excluída.']);
    }
}
