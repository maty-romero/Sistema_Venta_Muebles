<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductoVendido extends Model
{

    // TABLA RELACION CON AGREGACION

    use HasFactory;
    //campos solicitados al momento de enviar el request
    protected $fillable = [
        "unidades_vendidas_prod",
        "precio_venta_prod"

    ];
    protected $table = "producto_venta"; //tabla a referenciar

    // 1:M productoVendido-oferta

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_oferta");
    }
}
