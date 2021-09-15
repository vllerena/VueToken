<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\PermisoAttr;
use App\Models\Info\RolAttr;

class CreatePermisosRolesTable extends Migration
{
    private const TABLA_PERMISOS_ROLES = PermisoAttr::PERMISOS_ROLES;

    public function up()
    {
        Schema::create(self::TABLA_PERMISOS_ROLES, function (Blueprint $table) {
            $table->id();

            $table->foreignId('rol_id')
                ->constrained(RolAttr::NOMBRE_TABLA, RolAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreignId('permiso_id')
                ->constrained(PermisoAttr::NOMBRE_TABLA, PermisoAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(self::TABLA_PERMISOS_ROLES);
        Schema::enableForeignKeyConstraints();
    }
}
