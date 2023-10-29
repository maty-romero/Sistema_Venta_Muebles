<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfertaCombo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_oferta_combo';
    protected $fillable = [
        "nombre_combo",
    ];
    protected $table = "oferta_combo"; //tabla a referenciar


    // M:1 ofertaCombo-oferta

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_oferta_combo");
    }

    // M:M ofertaCombo-Ventas
    public function venta(): BelongsToMany
    {
        return $this->belongsToMany(Venta::class, "oferta_combo_venta", "id_oferta_combo", "id_venta")->withPivot('unidades_vendidas_combo', 'precio_combo');
    }

    // M:M ofertaCombo-producto

    public function oferta_combo_producto()
    {
        return $this->belongsToMany(Producto::class, 'oferta_combo_producto', 'id_oferta_combo', 'id_producto')->withPivot('cantidad_producto_combo');
    }
}
