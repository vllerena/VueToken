<?php

namespace App\Rules\Traits;

use App\Models\Info\RolAttr;
use App\Models\Info\UserAttr;
use Illuminate\Validation\Rule;

trait UserReglas
{

    public function usernameRules(): array
    {
        return ['required', 'string'];
    }

    public function usernameReglas($user, $required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        $unique = Rule::unique(UserAttr::NOMBRE_TABLA, UserAttr::USERNAME);
        $unique = $user ? $unique->ignore($user[UserAttr::ID]) : $unique;
        return [$required, $unique, 'string', 'max:50', 'min:3'];
    }

    public function dniReglas($user, $required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        $unique = Rule::unique(UserAttr::NOMBRE_TABLA, UserAttr::DNI);
        $unique = $user ? $unique->ignore($user[UserAttr::ID]) : $unique;
        return [$required, $unique, 'regex:/^[0-9]{8}+$/'];
    }

    public function nombresReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255', 'min:3'];
    }

    public function apellidosReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255', 'min:3'];
    }

    public function passwordReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:50', 'min:5'];
    }

    public function telefonoReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'numeric', 'regex:/\d{6,9}+$/'];
    }

    public function esAprobadoReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'boolean'];
    }

    public function descripcionReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255'];
    }

    public function rolReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, Rule::exists(RolAttr::NOMBRE_TABLA, RolAttr::ID)];
    }

    public function imagenReglas($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'image', 'max:6048', 'mimes:jpeg,png,gif'];
    }

    public function userNombreAttrs()
    {
        return [
            UserAttr::DNI => 'DNI',
            UserAttr::NOMBRES => 'nombres',
            UserAttr::AP_PATERNO => 'apellido paterno',
            UserAttr::AP_MATERNO => 'apellido materno',
            UserAttr::TELEFONO => 'teléfono',
            UserAttr::DESCRIPCION => 'descripción',
            UserAttr::PASSWORD => 'contraseña',
            UserAttr::ROL_ID => 'rol',
        ];
    }
}
