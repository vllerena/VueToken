<?php

namespace App\Models;

use App\Contracts\Autenticable;
use App\Models\Info\RolAttr;
use App\Models\Info\TokenAttr;
use App\Models\Info\UserAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements Autenticable
{
    use HasFactory, Notifiable;

    public const CREATED_AT = UserAttr::FECHA_CREADO;
    public const UPDATED_AT = UserAttr::FECHA_ACTUALIZADO;

    protected $fillable = [
        UserAttr::DNI,
        UserAttr::NOMBRES,
        UserAttr::AP_PATERNO,
        UserAttr::AP_MATERNO,
        UserAttr::USERNAME,
        UserAttr::PASSWORD,
        UserAttr::TELEFONO,
        UserAttr::DESCRIPCION,
        UserAttr::ESTA_ACTIVO,
        UserAttr::ES_SUPERUSER,
        UserAttr::PERFIL,
        UserAttr::ES_APROBADO,
        UserAttr::IP,
        UserAttr::LATITUD,
        UserAttr::LONGITUD,
    ];

    protected $table = UserAttr::NOMBRE_TABLA;

    protected $hidden = [
        UserAttr::PASSWORD,
    ];

    protected $casts = [
        UserAttr::ESTA_ACTIVO => 'boolean',
        UserAttr::ES_SUPERUSER => 'boolean',
        UserAttr::ES_APROBADO => 'boolean',
    ];

    public function getUser(): User
    {
        return $this;
    }

    static function getPrimaryKey()
    {
        return UserAttr::ID;
    }

    public function esSuperUser()
    {
        return $this[UserAttr::ES_SUPERUSER];
    }

    public function token()
    {
        return $this->hasOne(Token::class, TokenAttr::USER_ID,
            UserAttr::ID);
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, RolAttr::USER_ROLES,
            'user_id', 'rol_id');
    }
}
