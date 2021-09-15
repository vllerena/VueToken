<?php

namespace App\Policies;

use App\Contracts\AccionContract;
use App\Contracts\Autenticable;
use App\Contracts\EntidadContract;
use App\Contracts\PermisoContract;
use App\Models\Info\AccionAttr;
use App\Policies\Traits\AuthQuery;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccionPolicy
{
    use HandlesAuthorization;
    use AuthQuery;

    private const ENTIDAD_CLASS = 'App\Models\Accion';
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

    public function listar(Autenticable $auth)
    {
        $permiso = $this->getPermiso($auth->getUser(), AccionAttr::LISTAR, self::ENTIDAD_CLASS);
        return $permiso != null;
    }
}
