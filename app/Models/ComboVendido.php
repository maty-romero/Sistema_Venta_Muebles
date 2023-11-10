<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboVendido extends Model
{
    use HasFactory;

    // TABLA RELACION

    protected $fillable = [
        "id_venta",
        "id_oferta_combo",
        "unidades_vendidas_combo",
        "precio_combo"
    ];

    protected $table = "oferta_combo_venta"; //tabla a referenciar

}
