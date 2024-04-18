<?php

namespace App\Http\Controllers\Horario\Restricao;

use App\Http\Controllers\Controller;
use App\Services\Horario\Restricao\RestricaoClassificacaoService;
use Illuminate\Http\Request;

class RestricaoClassificacaoController extends Controller
{
    protected $service;

    public function __construct(RestricaoClassificacaoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->find(orderBy:['id','asc'])->get());
    }
 
}
