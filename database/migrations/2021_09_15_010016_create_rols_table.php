<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\RolAttr;
use App\Models\Info\UserAttr;

class CreateRolsTable extends Migration
{
    private const TABLA_ROL = RolAttr::NOMBRE_TABLA;
    private const TABLA_USER_ROLES = RolAttr::USER_ROLES;

    public function up()
    {
        Schema::create(self::TABLA_ROL, function (Blueprint $table) {
            $table->id(RolAttr::ID);
            $table->string(RolAttr::NOMBRE);
            $table->text(RolAttr::DESCRIPCION)->nullable();
            $table->timestamp(RolAttr::FECHA_CREADO)->nullable();
        });

        Schema::create(self::TABLA_USER_ROLES, function (Blueprint $table) {
            $table->id();

            $table->foreignId('rol_id')
                ->constrained(RolAttr::NOMBRE_TABLA, RolAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreignId('user_id')
                ->constrained(UserAttr::NOMBRE_TABLA, UserAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(self::TABLA_ROL);
        Schema::dropIfExists(self::TABLA_USER_ROLES);
        Schema::enableForeignKeyConstraints();
    }
}
