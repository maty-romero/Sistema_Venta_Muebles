<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha_inicio_oferta", 
        "fecha_fin_oferta", 
        "porcentaje_descuento", 
    ]; 
    protected $table = "ofertas"; //tabla a referenciar
}
