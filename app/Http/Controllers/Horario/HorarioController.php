<?php

namespace App\Http\Controllers\Horario;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\HorarioRequest;
use App\Services\Horario\HorarioService;
use Exception;
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
        return response()->json($this->service->find(with: ['usuarioCadastro'])->orderHorarioFilho()->get());
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

    public function criarCopia(int $id)
    {
        $result = $this->service->criarCopia($id);
        return response()->json(['message' => 'Registro Cadastrado.', 'result' => $result]);
    }

    public function update(HorarioRequest $request, int $id)
    {
        $validated = $request->all();
        $result = $this->service->update($id, $validated);
        $result->load('usuarioCadastro');
        return response()->json(['message' => 'Registro Atualizado.', 'result' => $result]);
    }


    public function destroy(int $id)
    {
        $coordernador = Auth::user()->perfil_id ?? 1;
        $horario = $this->service->find()->findOrFail($id);

        if(isset($horario['versao_atual']) && $horario['versao_atual']) {
            throw new Exception("Não é possível excluir o horário, pois está habilitado como versão final.");
        }
        
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

    public function ativarVersao(Request $request, int $id)
    {
       $request = $request->all();
       $result =  $this->service->ativarVersao($id, $request['versao_atual']);  
       return $result;
    }

    public function updateGeracao(Request $request, int $id)
    {
       $request = $request->all();
       $this->service->updateGeracao($id, $request['gerando']);  
    }
}
