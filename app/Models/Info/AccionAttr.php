<?php

namespace App\Models\Info;

class AccionAttr
{
    const NOMBRE_TABLA = 'acciones';
    const ID = 'id';
    const NOMBRE = 'nombre';
    const DESCRIPCION = 'descripcion';
    const NOMBRE_CLAVE = 'clave';

    const CREAR = 'crear';
    const LISTAR = 'listar';
    const DETALLE = 'detalle';
    const ACTUALIZAR = 'actualizar';
    const ELIMINAR = 'eliminar';

    static function getAcciones()
    {
        return [
            self::CREAR => [0 => "Crear", 1 => "Acción correspondiente al momento de realizar un registro"],
            self::LISTAR => [0 => "Listar", 1 => "Acción correspondiente al momento de listar registros"],
            self::DETALLE => [0 => "Detalle", 1 => "Acción correspondiente al momento de ver el detalle de un registro"],
            self::ACTUALIZAR => [0 => "Actualizar", 1 => "Acción correspondiente al momento de realizar un registro"],
            self::ELIMINAR => [0 => "Eliminar", 1 => "Acción correspondiente al momento de eliminar o deshabilitar un registro"],
        ];
    }
}
