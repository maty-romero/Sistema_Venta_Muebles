<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class OfertaMonto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_oferta_monto';
    protected $fillable = [
        "monto_limite_descuento"
    ];
    protected $table = "ofertas_montos"; //tabla a referenciar

    // M:1 ofertaMonto-oferta

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }

    // 1:M ofertaMonto-venta

    public function venta(): HasMany
    {
        return $this->hasMany(Venta::class, "id_oferta_monto");
    }

    public static function getOfertaMonto($monto)
    {
        $idOferta = DB::table('ofertas_montos')->select('id_oferta_monto')->where('monto_limite_descuento', '<=', $monto)->orderBy('monto_limite_descuento', 'desc')->first();
        if(isset($idOferta) && !is_null($idOferta)){
            $oferta = Oferta::findOrFail($idOferta->id_oferta_monto);
            return $oferta;
        }
        return null;
    }
}
