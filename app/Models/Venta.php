<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ["nombre_cliente", "tipo_cliente", "dni_cuit", "codigo_postal_cliente", "email"]; //campos solicitados al momento de enviar el request
    protected $table = "clientes"; //tabla a referenciar

    //Relaciones 

    //M a 1 Clientes
    
}
