<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;


    protected $fillable = [
        "nombre_producto",
        "descripcion",
        "discontinuado",
        "stock",
        "precio_producto",
        "largo",
        "ancho",
        "alto",
        "material",
        "id_tipo_mueble"
    ];

    protected $table = "productos"; //tabla a referenciar


    public function tipo_mueble(): BelongsTo
    {
        return $this->belongsTo(TipoMueble::class, "id_tipo_mueble");
    }
}
