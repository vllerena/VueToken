<?php

namespace App\Rules\Traits;

use App\Models\Info\AccionAttr;
use App\Models\Info\EntidadAttr;
use App\Models\Info\PermisoAttr;
use Illuminate\Validation\Rule;

trait PermisoReglas
{
    public function nombreReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255', 'min:3'];
    }

    public function descripcionReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255'];
    }

    public function entidadIdReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, Rule::exists(EntidadAttr::NOMBRE_TABLA, EntidadAttr::ID)];
    }

    public function accionIdReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, Rule::exists(AccionAttr::NOMBRE_TABLA, AccionAttr::ID)];
    }

    public function nombresAtributos()
    {
        return [
            PermisoAttr::NOMBRE => 'nombre clave',
            PermisoAttr::ENTIDAD_ID => 'entidad',
            PermisoAttr::ACCION_ID => 'acción',
        ];
    }
}
