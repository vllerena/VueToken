<?php

namespace App\Contracts;

use App\Models\Rol;
use Illuminate\Http\Request;

interface RolContract
{
    public function filtrarRoles(Request $request, $cantidad = '*');

    public function crearRol(array $datos): Rol;

    public function editarRol(Rol $rol, array $datos);

    public function eliminarRol(Rol $rol);
}
