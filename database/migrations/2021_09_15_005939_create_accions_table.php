<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\AccionAttr;

class CreateAccionsTable extends Migration
{
    private const TABLA_ACCION = AccionAttr::NOMBRE_TABLA;

    public function up()
    {
        Schema::create(self::TABLA_ACCION, function (Blueprint $tabla) {
            $tabla->id(AccionAttr::ID);
            $tabla->string(AccionAttr::NOMBRE_CLAVE);
            $tabla->string(AccionAttr::NOMBRE, 150);
            $tabla->string(AccionAttr::DESCRIPCION, 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLA_ACCION);
    }
}
