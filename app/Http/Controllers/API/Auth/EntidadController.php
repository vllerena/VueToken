<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\EntidadContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntidadController extends Controller
{
    private EntidadContract $entidadService;

    public function __construct(EntidadContract $entidadService)
    {
        $this->entidadService = $entidadService;
    }

    public function listarEntidades(Request $request)
    {
        $entidades = $this->entidadService->listarEntidades($request);
        return response()->json($entidades);
    }
}
