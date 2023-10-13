<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMueble extends Model
{
    use HasFactory;

    protected $fillable = ["nombre_tipo_mueble"];
    protected $table = "tipos_muebles"; //tabla a referenciar

}
