<?php

namespace App\Models;

use App\Models\Info\AccionAttr;
use App\Models\Info\EntidadAttr;
use App\Models\Info\PermisoAttr;
//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
//    use Filterable;

    public const CREATED_AT = PermisoAttr::FECHA_CREADO;
    public const UPDATED_AT = PermisoAttr::FECHA_ACTUALIZADO;

    protected $table = PermisoAttr::NOMBRE_TABLA;

    protected $casts = [
        PermisoAttr::FECHA_CREADO => 'datetime',
        PermisoAttr::FECHA_ACTUALIZADO => 'datetime',
    ];

//    protected $fillable = [
//        PermisoAttr::NOMBRE,
//        PermisoAttr::ENTIDAD_ID,
//        PermisoAttr::ACCION_ID,
//        PermisoAttr::DESCRIPCION,
//    ];

    public function accion()
    {
        return $this->hasOne(Accion::class, AccionAttr::ID, PermisoAttr::ACCION_ID);
    }

    public function entidad()
    {
        return $this->hasOne(Entidad::class, EntidadAttr::ID, PermisoAttr::ENTIDAD_ID);
    }
}
