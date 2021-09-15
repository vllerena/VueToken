<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\EntidadAttr;

class CreateEntidadsTable extends Migration
{
    private const TABLA_ENTIDAD = EntidadAttr::NOMBRE_TABLA;

    public function up()
    {
        Schema::create(self::TABLA_ENTIDAD, function (Blueprint $tabla) {
            $tabla->id(EntidadAttr::ID);
            $tabla->string(EntidadAttr::CLASS_NAME);
            $tabla->string(EntidadAttr::NOMBRE);
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLA_ENTIDAD);
    }
}
