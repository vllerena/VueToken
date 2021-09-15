<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface AccionContract
{
    public function listarAcciones(Request $request, $cantidad = '*');

    public function whereFirst($attr, $value);
}
