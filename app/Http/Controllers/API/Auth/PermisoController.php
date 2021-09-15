<?php

namespace App\Http\Controllers\API\Auth;

use App\Contracts\PermisoContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Permiso\CrearPermisoRequest;
use App\Http\Requests\Auth\Permiso\EditarPermisoRequest;
use App\Models\Permiso;
use App\Utils\HttpStatus;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    private PermisoContract $permisoService;

    public function __construct(PermisoContract $permisoService)
    {
        $this->permisoService = $permisoService;
    }

    public function filtrarPermisos(Request $request)
    {
        $permisos = $this->permisoService->filtrarPermisos($request, 15);
        return response()->json($permisos);
    }

    public function crearPermiso(CrearPermisoRequest $request)
    {
        $permiso = $this->permisoService->crearPermiso($request->validated());
        return response()->json($permiso);
    }

    public function editarPermiso(EditarPermisoRequest $request, Permiso $permiso)
    {
        $this->permisoService->editarPermiso($permiso, $request->validated());
        return response()->json($permiso);
    }

    public function detallePermiso(Permiso $permiso)
    {
        return response()->json($permiso);
    }

    public function eliminarPermiso(Permiso $permiso)
    {
        $this->permisoService->eliminarPermiso($permiso);
        return response()->json([], HttpStatus::HTTP_204_NO_CONTENT);
    }
}
