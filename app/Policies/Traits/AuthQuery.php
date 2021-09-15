<?php

namespace App\Policies\Traits;

use App\Models\Info\AccionAttr;
use App\Models\Info\EntidadAttr;
use App\Models\User;

trait AuthQuery
{
    public function getPermiso(User $user, string $accionStr, string $entidadStr)
    {
        [$accion, $entidad] = $this->getAccionYEntidad($accionStr, $entidadStr);
        return $this->permisoService->getPermisoFromUser($user, $accion[AccionAttr::ID], $entidad[EntidadAttr::ID]);
    }

    private function getAccionYEntidad(string $accionStr, string $entidadStr)
    {
        $accion = $this->getAccion($accionStr);
        $entidad = $this->getEntidad($entidadStr);
        return [$accion, $entidad];
    }

    private function getAccion(string $accionStr)
    {
        return $this->accionService->whereFirst(AccionAttr::NOMBRE_CLAVE, $accionStr);
    }

    private function getEntidad(string $entidadStr)
    {
        return $this->entidadService->whereFirst(EntidadAttr::CLASS_NAME, $entidadStr);
    }
}
