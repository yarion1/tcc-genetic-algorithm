<?php

namespace App\Http\Controllers;

use App\Services\UnavailableTimeslotService;
use Illuminate\Http\Request;

class UnavailableTimeslotController extends Controller
{
    protected $service;

    public function __construct(UnavailableTimeslotService $service)
    {
        $this->service = $service;
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Registro Excluído.']);
    }
}
