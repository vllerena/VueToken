<?php

namespace App\Models;

use App\Models\Info\EntidadAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = EntidadAttr::NOMBRE_TABLA;
}
