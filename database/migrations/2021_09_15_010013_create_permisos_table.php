<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\PermisoAttr;
use App\Models\Info\EntidadAttr;
use App\Models\Info\AccionAttr;

class CreatePermisosTable extends Migration
{
    private const TABLA_PERMISO = PermisoAttr::NOMBRE_TABLA;

    public function up()
    {
        Schema::create(self::TABLA_PERMISO, function (Blueprint $tabla) {
            $tabla->id(PermisoAttr::ID);
            $tabla->foreignId(PermisoAttr::ENTIDAD_ID)
                ->constrained(EntidadAttr::NOMBRE_TABLA, EntidadAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $tabla->foreignId(PermisoAttr::ACCION_ID)
                ->constrained(AccionAttr::NOMBRE_TABLA, AccionAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $tabla->string(PermisoAttr::NOMBRE);
            $tabla->text(PermisoAttr::DESCRIPCION)->nullable();
            $tabla->timestamp(PermisoAttr::FECHA_CREADO)->nullable();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(self::TABLA_PERMISO);
        Schema::enableForeignKeyConstraints();
    }
}
