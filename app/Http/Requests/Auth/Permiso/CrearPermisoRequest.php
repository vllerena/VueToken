<?php

namespace App\Http\Requests\Auth\Permiso;

use App\Models\Info\PermisoAttr;
use App\Rules\Traits\PermisoReglas;
use Illuminate\Foundation\Http\FormRequest;

class CrearPermisoRequest extends FormRequest
{
    use PermisoReglas;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            PermisoAttr::NOMBRE => $this->nombreReglas(),
            PermisoAttr::DESCRIPCION => $this->nombreReglas(false, true),
            PermisoAttr::ENTIDAD_ID => $this->entidadIdReglas(),
            PermisoAttr::ACCION_ID => $this->accionIdReglas(),
        ];
    }

    public function attributes()
    {
        return $this->nombresAtributos();
    }
}
