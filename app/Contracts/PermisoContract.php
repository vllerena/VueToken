<?php

namespace App\Contracts;

use App\Models\Permiso;
use App\Models\User;
use Illuminate\Http\Request;

interface PermisoContract
{
    public function filtrarPermisos(Request $request, $cantidad = '*');

    public function crearPermiso(array $datos);

    public function editarPermiso(Permiso $permiso, array $datos);

    public function eliminarPermiso(Permiso $permiso);

    public function getPermisoFromUser(User $user, $accionId, $entidadId);

    public function whereIn($attr, $ids);
}
