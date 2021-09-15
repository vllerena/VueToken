<?php

namespace App\Services;

use App\Contracts\EntidadContract;
use App\Models\Entidad;
use App\Models\Info\EntidadAttr;
use Illuminate\Http\Request;

class EntidadService implements EntidadContract
{

    public function whereFirst($attr, $value)
    {
        return Entidad::where($attr, $value)->first();
    }

    public function listarEntidades(Request $request, $cantidad = '*')
    {
        return Entidad::orderBy(EntidadAttr::NOMBRE, 'ASC')->get();
    }
}
