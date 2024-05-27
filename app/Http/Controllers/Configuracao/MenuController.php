<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use App\Models\ModelFront\Menu;
use App\Models\ModelFront\MenuPerfil;
use App\Services\Configuracao\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    protected $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $perfilId = Auth::user()->perfil_id;

        $dadosCadastraisExistem = MenuPerfil::where('perfil_id', $perfilId)->exists();

        if (!$dadosCadastraisExistem) {
            return response()->json([]);
        }

        $sistemas = Menu::with(['items' => function ($query) use ($perfilId) {
            $query->whereHas('menuPerfil', function ($query) use ($perfilId) {
                $query->where('perfil_id', $perfilId);
            })->select('id', 'label', 'raiz', 'icon', 'to')->with('pai')->orderBy('id', 'asc');
        }])
            ->whereHas('menuPerfil', function ($query) use ($perfilId) {
                $query->where('perfil_id', $perfilId);
            })
            ->whereNull('raiz')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json($sistemas);
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
