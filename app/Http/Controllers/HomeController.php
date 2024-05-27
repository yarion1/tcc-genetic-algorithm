<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $service;

    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getDados());
    }
}
