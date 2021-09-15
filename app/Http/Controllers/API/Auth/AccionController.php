<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\AccionContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccionController extends Controller
{
    private AccionContract $accionService;

    public function __construct(AccionContract $accionService)
    {
        $this->accionService = $accionService;
    }

    public function listarAcciones(Request $request)
    {
        $acciones = $this->accionService->listarAcciones($request);
        return response()->json($acciones);
    }
}
