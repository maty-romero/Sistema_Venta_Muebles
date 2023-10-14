<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OfertaMonto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_oferta_monto';
    protected $fillable = [
        "monto_limite_descuento"
    ];
    protected $table = "ofertas_montos"; //tabla a referenciar


    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }


    public function venta(): HasMany
    {
        return $this->hasMany(Venta::class, "id_oferta_monto");
    }
}
