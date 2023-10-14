<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCombo extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_producto", 
        "id_oferta_combo", 
        "cantidad_producto_combo", 
    ]; 
    protected $table = "detalles_combos"; //tabla a referenciar

    

}
