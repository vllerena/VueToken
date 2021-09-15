<?php

namespace App\Contracts;

use App\Utils\Archivo;

interface ArchivoContract
{
    public function saveUploadedFile(Archivo $archivo, $conUrl = true);
}
