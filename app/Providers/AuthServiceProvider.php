<?php

namespace App\Providers;

use App\Contracts\Autenticable;
use App\Models\Accion;
use App\Models\Entidad;
use App\Models\Permiso;
use App\Models\Rol;
use App\Policies\AccionPolicy;
use App\Policies\EntidadPolicy;
use App\Policies\PermisoPolicy;
use App\Policies\RolPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Rol::class => RolPolicy::class,
        Permiso::class => PermisoPolicy::class,
        Accion::class => AccionPolicy::class,
        Entidad::class => EntidadPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (Autenticable $auth, $ability) {
            if ($auth->getUser()->esSuperUser()) {
                return true;
            }
        });

    }
}
