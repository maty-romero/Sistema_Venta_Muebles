<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venta extends Model
{
    use HasFactory;
    //campos solicitados al momento de enviar el request
    protected $fillable = [
        "nombre_cliente", 
        "tipo_cliente", 
        "dni_cuit", 
        "codigo_postal_cliente", 
        "email"
    ]; 
    protected $table = "ventas"; //tabla a referenciar

    //Relaciones 

    //M a 1 Clientes
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_usuario_cliente');
    }

    
}
