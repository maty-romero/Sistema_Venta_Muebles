<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha_inicio_oferta",
        "fecha_fin_oferta",
        "porcentaje_descuento",
    ];
    protected $table = "ofertas"; //tabla a referenciar

    // M:M producto-oferta

    public function producto(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, "oferta_producto", "id_oferta", "id_producto");
    }

    // 1:M oferta-combo

    public function ofertaCombo(): hasMany
    {
        return $this->hasMany(OfertaCombo::class, "id_oferta_combo");
    }

    // 1:M oferta-monto

    public function ofertaMonto(): hasMany
    {
        return $this->hasMany(OfertaMonto::class, "id_oferta_monto");
    }

    // 1:M oferta-mueble

    public function ofertaMueble(): hasMany
    {
        return $this->hasMany(OfertaTipoMueble::class, "id_oferta_tipo");
    }
}
