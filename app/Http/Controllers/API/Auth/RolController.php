<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\RolContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Rol\CrearRolRequest;
use App\Http\Requests\Auth\Rol\EditarRolRequest;
use App\Models\Rol;
use App\Utils\HttpStatus;
use Illuminate\Http\Request;

class RolController extends Controller
{
    private RolContract $rolService;

    public function __construct(RolContract $rolService)
    {
        $this->rolService = $rolService;
    }

    public function filtrarRoles(Request $request)
    {
        $roles = $this->rolService->filtrarRoles($request, 15);
        return response()->json($roles);
    }

    public function crearRol(CrearRolRequest $request)
    {
        $rol = $this->rolService->crearRol($request->validated());
        return response()->json($rol);
    }

    public function editarRol(EditarRolRequest $request, Rol $rol)
    {
        $this->rolService->editarRol($rol, $request->validated());
        return response()->json($rol);
    }

    public function eliminarRol(Rol $rol)
    {
        $this->rolService->eliminarRol($rol);
        return response()->json([], HttpStatus::HTTP_204_NO_CONTENT);
    }

    public function detalleRol(Rol $rol)
    {
        return response()->json($rol);
    }
}
