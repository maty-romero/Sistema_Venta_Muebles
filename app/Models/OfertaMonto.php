<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaMonto extends Model
{
    use HasFactory;
    protected $fillable = [
        "monto_limite_descuento" 
    ]; 
    protected $table = "ofertas_montos"; //tabla a referenciar

}
