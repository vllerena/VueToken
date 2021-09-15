<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface EntidadContract
{
    public function whereFirst($attr, $value);

    public function listarEntidades(Request $request, $cantidad = '*');
}
