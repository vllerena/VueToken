<?php

namespace Database\Seeders;

use App\Models\Entidad;
use App\Models\Info\EntidadAttr;
use Illuminate\Database\Seeder;

class EntidadSeeder extends Seeder
{
    public function run()
    {
        $entidades = EntidadAttr::entidades();
        foreach ($entidades as $k => $v)
            Entidad::updateOrCreate([
                EntidadAttr::CLASS_NAME => $k
            ], [
                EntidadAttr::NOMBRE => $v,
                EntidadAttr::CLASS_NAME => $k
            ]);
    }
}
