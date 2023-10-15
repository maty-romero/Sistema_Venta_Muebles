<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = "id_usuario_cliente";
    protected $fillable = ["nombre_cliente", "tipo_cliente", "dni_cuit", "codigo_postal_cliente"]; //campos solicitados al momento de enviar el request
    protected $table = "clientes"; //tabla a referenciar

    // Relaciones 

    //1 a M con Venta
    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, "id_usuario_cliente");
    }

    //1:1 cliente-usuario

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_usuario_cliente");
    }
}
