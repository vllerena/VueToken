<?php

namespace App\Services;

use App\Contracts\PermisoContract;
use App\Models\Info\PermisoAttr;
use App\Models\Info\RolAttr;
use App\Models\Info\UserAttr;
use App\Models\Permiso;
use App\Models\User;
use Illuminate\Http\Request;

class PermisoService implements PermisoContract
{

    public function whereIn($attr, $ids)
    {
        return Permiso::whereIn($attr, $ids)->get();
    }

    public function filtrarPermisos(Request $request, $cantidad = '*')
    {
        $query = Permiso::with('entidad')->with('accion')->orderBy(PermisoAttr::FECHA_CREADO, 'DESC')->filter($request->all());
        if ($cantidad == '*')
            return $query->get();
        return $query->paginate($cantidad);
    }

    public function crearPermiso(array $datos)
    {
        return Permiso::create($datos);
    }

    public function editarPermiso(Permiso $permiso, array $datos)
    {
        $permiso->update($datos);
        return $permiso;
    }

    public function eliminarPermiso(Permiso $permiso)
    {
        $permiso->delete();
        return $permiso;
    }

    public function getPermisoFromUser(User $user, $accionId, $entidadId)
    {
        $userRoleTable = RolAttr::USER_ROLES;
        $userTable = UserAttr::NOMBRE_TABLA;
        $userTableId = UserAttr::ID;
        $rolTable = RolAttr::NOMBRE_TABLA;
        $rolTableId = RolAttr::ID;
        $permisoRolTable = PermisoAttr::PERMISOS_ROLES;
        $permisoTable = PermisoAttr::NOMBRE_TABLA;
        $permisoTableId = PermisoAttr::ID;
        return Permiso::query()
            ->select("$permisoTable.*")
            ->join($permisoRolTable, "$permisoRolTable.permiso_id", '=', "$permisoTable.$permisoTableId")
            ->join($rolTable, "$permisoRolTable.rol_id", '=', "$rolTable.$rolTableId")
            ->join($userRoleTable, "$userRoleTable.rol_id", "=", "$rolTable.$rolTableId")
            ->join($userTable, "$userRoleTable.user_id", '=', "$userTable.$userTableId")
            ->where("$userTable.$userTableId", "=", $user[UserAttr::ID])
            ->where("$permisoTable." . PermisoAttr::ACCION_ID, '=', $accionId)
            ->where("$permisoTable." . PermisoAttr::ENTIDAD_ID, '=', $entidadId)
            ->first();
    }
}
