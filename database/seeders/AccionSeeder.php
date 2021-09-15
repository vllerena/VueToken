<?php

namespace Database\Seeders;

use App\Models\Accion;
use App\Models\Info\AccionAttr;
use Illuminate\Database\Seeder;

class AccionSeeder extends Seeder
{
    public function run()
    {
        $acciones = AccionAttr::getAcciones();
        foreach ($acciones as $k => $v) {
            Accion::updateOrCreate([
                AccionAttr::NOMBRE_CLAVE => $k
            ], [
                AccionAttr::NOMBRE_CLAVE => $k,
                AccionAttr::NOMBRE => $v[0],
                AccionAttr::DESCRIPCION => $v[1],
            ]);
        }
    }
}
