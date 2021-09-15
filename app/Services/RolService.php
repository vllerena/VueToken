<?php

namespace App\Services;

use App\Contracts\RolContract;
use App\Models\Info\PermisoAttr;
use App\Models\Info\RolAttr;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RolService implements RolContract
{

    public function filtrarRoles(Request $request, $cantidad = '*')
    {
        $query = Rol::orderBy(RolAttr::FECHA_CREADO, 'DESC')->with('permisos')->filter($request->all());
        if ($cantidad == '*')
            return $query->get();
        return $query->paginate($cantidad);
    }

    public function crearRol(array $datos): Rol
    {
        $rol = Rol::create($datos);
        $this->setPermisos($rol, $datos[RolAttr::PERMISOS_ATTR]);
        return $rol;
    }

    public function editarRol(Rol $rol, array $datos)
    {
        $rol->update($datos);
        $this->setPermisos($rol, Arr::get($datos, RolAttr::PERMISOS_ATTR, []));
        return $rol;
    }

    public function eliminarRol(Rol $rol)
    {
        $rol->delete();
        return $rol;
    }

    private function setPermisos(Rol $rol, $permisosIds)
    {
        if (count($permisosIds)) {
            $this->deletePermisosFromRol($rol[RolAttr::ID]);
            for ($i = 0; $i < count($permisosIds); $i++)
                $this->insertPerms($rol[RolAttr::ID], $permisosIds[$i]);
        }
    }

    private function deletePermisosFromRol($rolId): void
    {
        DB::table(PermisoAttr::PERMISOS_ROLES)
            ->where('rol_id', $rolId)
            ->delete();
    }

    private function insertPerms($rolId, $permId): void
    {
        DB::table(PermisoAttr::PERMISOS_ROLES)->insert([
            'permiso_id' => $permId,
            'rol_id' => $rolId
        ]);
    }
}
