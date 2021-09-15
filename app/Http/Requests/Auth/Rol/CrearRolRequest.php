<?php

namespace App\Http\Requests\Auth\Rol;

use App\Contracts\PermisoContract;
use App\Models\Info\RolAttr;
use App\Rules\Traits\RolReglas;
use Illuminate\Foundation\Http\FormRequest;

class CrearRolRequest extends FormRequest
{
    use RolReglas;

    public function authorize()
    {
        return true;
    }

    public function rules(PermisoContract $permisoService)
    {
        return [
            RolAttr::NOMBRE => $this->nombreReglas(),
            RolAttr::DESCRIPCION => $this->descripcionReglas(false, true),
            RolAttr::PERMISOS_ATTR => $this->permisosAttrReglas($permisoService),
        ];
    }
}
