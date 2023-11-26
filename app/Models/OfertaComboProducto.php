<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfertaComboProducto extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["cantidad_producto_combo", "id_producto", "id_oferta_combo"];
    protected $table = "oferta_combo_producto"; //tabla a referenciar
}
