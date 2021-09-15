<?php

namespace App\Models;

use App\Models\Info\PermisoAttr;
use App\Models\Info\RolAttr;
//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
//    use Filterable;

    public const CREATED_AT = RolAttr::FECHA_CREADO;
    public const UPDATED_AT = null;
    protected $table = RolAttr::NOMBRE_TABLA;

    protected $casts = [
        RolAttr::FECHA_CREADO => 'datetime',
    ];

//    protected $fillable = [
//        RolAttr::NOMBRE,
//        RolAttr::DESCRIPCION,
//    ];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class,
            PermisoAttr::PERMISOS_ROLES, 'rol_id', 'permiso_id');
    }
}
