<?php

namespace App\Rules;

use App\Contracts\PermisoContract;
use App\Models\Info\PermisoAttr;
use Illuminate\Contracts\Validation\Rule;

class PermisoUnicoRule implements Rule
{
    private PermisoContract $permisoService;

    public function __construct(PermisoContract $permisoService)
    {
        $this->permisoService = $permisoService;
    }

    public function passes($attribute, $value)
    {
        $permisos = $this->permisoService->whereIn(PermisoAttr::ID, $value);
        return !$this->existeMismaAccion($permisos);
    }

    public function message()
    {
        return 'Ya existe un permiso para la entidad con la misma acción.';
    }

    private function existeMismaAccion($permisos)
    {
        for ($i = 0; $i < count($permisos); $i++) {
            $pi = $permisos[$i];
            for ($j = $i + 1; $j < count($permisos); $j++) {
                $pj = $permisos[$j];
                if ($pi[PermisoAttr::ACCION_ID] == $pj[PermisoAttr::ACCION_ID] &&
                    $pi[PermisoAttr::ENTIDAD_ID] == $pj[PermisoAttr::ENTIDAD_ID])
                    return true;
            }
        }
        return false;
    }
}
