<?php

namespace App\Models;

use App\Models\Info\AccionAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = AccionAttr::NOMBRE_TABLA;
}
