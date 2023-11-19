<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleCombo extends Model
{
    use HasFactory, SoftDeletes;

    // TABLA RELACION

    protected $fillable = [
        "id_producto",
        "id_oferta_combo",
        "cantidad_producto_combo",
    ];

    protected $table = "oferta_combo_producto"; //tabla a referenciar

}
