<?php

namespace App\Http\Controllers\Pessoa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pessoa\PessoaRequest;
use App\Models\ModelFront\Curso;
use App\Models\ModelFront\Pessoa;
use App\Services\Pessoa\PessoaService;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;

class PessoaController extends Controller
{

    protected $service;

    public function __construct(PessoaService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required',
            'senha' => 'required',
        ]);
        $credentials = ['cpf' => $validated['cpf'], 'password' => $validated['senha']];
        $token = Auth::attempt($credentials);

        if ($token) {
            return response()->json(['message' => 'Usuário Autenticado com Sucesso.', 'token' => $token, 'usuario' => auth()->user()->only(['id', 'nome', 'email', 'foto', 'apelido', 'perfil_id'])]);
        } else {
            return response()->json(['message' => 'Credenciais Inválidas.'], 401);
        }

        return response()->json($this->service->find()->get());
    }
    public function register(PessoaRequest $request)
    {
       
        $validated = $request->validated();
        $this->service->advancedCreate([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'apelido' => $validated['apelido'],
            'telefone' => $validated['telefone'],
            'perfil_id' => (int) $validated['usuario_id'], 
            'cpf' => $validated['cpf'],
            'curso_id' => (int) $validated['curso_id'], 
            'senha' => Hash::make($validated['senha']),
        ]);
        $credentials = ['email' => $validated['email'], 'password' => $validated['senha']];
        $token = Auth::attempt($credentials);
        
        if ($token) {
            return response()->json(['message' => 'Pessoa Cadastrada e Autenticada com Sucesso.', 'token' => $token, 'usuario' => auth()->user()->only(['id', 'nome', 'email', 'foto', 'apelido', 'perfil_id'])]);
        } else {
            return response()->json(['message' => 'Credenciais Inválidas.'], 401);
        }
    }

    public function usuario()
    {
        return response()->json(auth()->user()->only(['id', 'nome', 'email', 'foto', 'apelido', 'perfil_id']));
    }

    public function index()
    {
        return response()->json($this->service->find()->get());
    }

    public function cursos()
    {
        return response()->json(Curso::select('id', 'sigla', 'nome')->get());
    }


    public function store(PessoaRequest $request)
    {
        $validated = $request->validated();
        $this->service->advancedCreate($validated);
        return response()->json(['message' => 'Pessoa Cadastrada.']);
    }

    public function show(int $id)
    {
        return response()->json($this->service->find()->findOrFail($id));
    }

    public function update(PessoaRequest $request, int $id)
    {
        $validated = $request->validated();
        $this->service->advancedUpdate($id, $validated);
        return response()->json(['message' => 'Pessoa Atualizada.']);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Pessoa Excluída.']);
    }

    public function alterarDados(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:filter',
            'apelido' => 'nullable|string',
            'fone' => 'nullable',
            'cpf' => 'required',
            'nome' => 'required',
            'foto' => 'nullable',
            'numero' => 'nullable',
        ]);

        $usuario =  Auth::user();
        $result = $this->service->alterarMeusDados($usuario->id, $validated);
        return response()->json(['message' => 'Usuário atualizado', 'result' => $result]);
    }

}
