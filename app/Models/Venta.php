<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Venta extends Model
{
    use HasFactory;
    //campos solicitados al momento de enviar el request
    protected $fillable = [
        "fecha_venta",
        "monto_final_venta",
        "nro_pago",
        "codigo_postal_destino",
        "domicilio_destino",
        "id_usuario_cliente",
        "id_oferta_monto"
    ];
    protected $table = "ventas"; //tabla a referenciar

    //Relaciones 

    //M a 1 Clientes
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_usuario_cliente');
    }
}
