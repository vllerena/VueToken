<?php

namespace App\Models\Info;

class EntidadAttr
{
    const NOMBRE_TABLA = 'entidades';
    const ID = 'id';
    const CLASS_NAME = 'class_name';
    const NOMBRE = 'nombre';

    static function entidades()
    {
        return [
            "App\Models\Permiso" => "permiso(s)",
            "App\Models\Rol" => "rol(es)",
            "App\Models\Accion" => "acción(es)",
            "App\Models\Entidad" => "entidad(es)",
            "App\Models\Categoria" => "categoria(s)",
        ];
    }
}
