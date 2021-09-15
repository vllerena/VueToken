<?php

namespace App\Services;

use App\Contracts\AccionContract;
use App\Models\Accion;
use App\Models\Info\AccionAttr;
use Illuminate\Http\Request;

class AccionService implements AccionContract
{

    public function whereFirst($attr, $value)
    {
        return Accion::where($attr, $value)->first();
    }

    public function listarAcciones(Request $request, $cantidad = '*')
    {
        return Accion::orderBy(AccionAttr::NOMBRE, 'ASC')->get();
    }
}
