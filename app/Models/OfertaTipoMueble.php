<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaTipoMueble extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_tipo_mueble" 
    ]; 
    protected $table = "ofertas_tipos_muebles"; //tabla a referenciar
}
