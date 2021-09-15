<?php

namespace App\Providers;

use App\Contracts\AccionContract;
use App\Contracts\ArchivoContract;
use App\Contracts\EntidadContract;
use App\Contracts\PermisoContract;
use App\Contracts\RolContract;
use App\Contracts\TokenContract;
use App\Contracts\UserContract;
use App\Services\AccionService;
use App\Services\EntidadService;
use App\Services\PermisoService;
use App\Services\RolService;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    public $bindings = [
        TokenContract::class => TokenService::class,
        UserContract::class => UserService::class,
        RolContract::class => RolService::class,
        PermisoContract::class => PermisoService::class,
        AccionContract::class => AccionService::class,
        EntidadContract::class => EntidadService::class,
    ];

    public function register()
    {

    }
}
