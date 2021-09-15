<?php

namespace App\Rules\Traits;

use App\Contracts\PermisoContract;
use App\Models\Info\PermisoAttr;
use App\Rules\PermisoUnicoRule;
use Illuminate\Validation\Rule;

trait RolReglas
{
    public function nombreReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255'];
    }

    public function descripcionReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255'];
    }

    public function permisosAttrReglas(PermisoContract $permisoService, $required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [
            $required, 'array', Rule::exists(PermisoAttr::NOMBRE_TABLA, PermisoAttr::ID),
            new PermisoUnicoRule($permisoService)
        ];
    }
}
