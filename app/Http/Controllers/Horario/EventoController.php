<?php

namespace App\Http\Controllers\Horario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\EventoRequest;
use App\Services\Horario\EventoService;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    protected $service;

    public function __construct(EventoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find()->get());
    }


    public function store(EventoRequest $request)
    {

        $validated = $request->all();
        $result = $this->service->createEventoHorario($validated);
        return response()->json(['message' => 'Registro Cadastrado.', 'result' => $result]);
    }


    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->all();
        $result = $this->service->update($id, $validated);

        // if(!isset($validated['drop'])) {
        $result->load([
            'room', 'day', 'course', 'college_class', 'professor:id,pessoa_id,carga_horaria,substitute',
            'professor.pessoa:id,nome,apelido'
        ]);
        $result->daysOfWeek = [$result->day->daysOfWeek];
        $result = [...$result->toArray(), 'periodo' => $validated['periodo']];
        // }

        return response()->json(['message' => 'Registro Atualizado.', 'result' => $result]);
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
