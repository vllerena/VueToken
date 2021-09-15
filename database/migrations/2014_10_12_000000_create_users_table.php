<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\UserAttr;

class CreateUsersTable extends Migration
{
    private const USERS_TABLE = UserAttr::NOMBRE_TABLA;

    public function up()
    {
        Schema::create(self::USERS_TABLE, function (Blueprint $table) {
            $table->id(UserAttr::ID);
            $table->char(UserAttr::DNI, 8)->unique()->nullable();
            $table->string(UserAttr::NOMBRES)->nullable();
            $table->string(UserAttr::AP_PATERNO)->nullable();
            $table->string(UserAttr::AP_MATERNO)->nullable();
            $table->string(UserAttr::TELEFONO, 12)->nullable();
            $table->text(UserAttr::DESCRIPCION)->nullable();
            $table->string(UserAttr::USERNAME)->unique();
            $table->string(UserAttr::PASSWORD);
            $table->boolean(UserAttr::ESTA_ACTIVO)->default(true);
            $table->boolean(UserAttr::ES_SUPERUSER)->default(false);
            $table->timestamp(UserAttr::FECHA_CREADO)->nullable();
            $table->timestamp(UserAttr::FECHA_ACTUALIZADO)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::USERS_TABLE);
    }
}
