<?php

namespace App\Policies;

use App\Contracts\AccionContract;
use App\Contracts\Autenticable;
use App\Contracts\EntidadContract;
use App\Contracts\PermisoContract;
use App\Models\Info\AccionAttr;
use App\Models\Rol;
use App\Policies\Traits\AuthQuery;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolPolicy
{
    use HandlesAuthorization;
    use AuthQuery;

    private const ENTIDAD_CLASS = 'App\Models\Rol';
    private AccionContract $accionService;
    private EntidadContract $entidadService;
    private PermisoContract $permisoService;

    public function __construct(AccionContract $accionService, EntidadContract $entidadService,
                                PermisoContract $permisoService)
    {
        $this->accionService = $accionService;
        $this->entidadService = $entidadService;
        $this->permisoService = $permisoService;
    }

    public function crear(Autenticable $auth)
    {
        $permiso = $this->getPermiso($auth->getUser(), AccionAttr::CREAR, self::ENTIDAD_CLASS);
        return $permiso != null;
    }

    public function listar(Autenticable $auth)
    {
        $permiso = $this->getPermiso($auth->getUser(), AccionAttr::LISTAR, self::ENTIDAD_CLASS);
        return $permiso != null;
    }

    public function detalle(Autenticable $auth, Rol $rol)
    {
        $permiso = $this->getPermiso($auth->getUser(), AccionAttr::DETALLE, self::ENTIDAD_CLASS);
        return $permiso != null;
    }

    public function actualizar(Autenticable $auth, Rol $rol)
    {
        $permiso = $this->getPermiso($auth->getUser(), AccionAttr::ACTUALIZAR, self::ENTIDAD_CLASS);
        return $permiso != null;
    }

    public function eliminar(Autenticable $auth, Rol $rol)
    {
        $permiso = $this->getPermiso($auth->getUser(), AccionAttr::ELIMINAR, self::ENTIDAD_CLASS);
        return $permiso != null;
    }
}
