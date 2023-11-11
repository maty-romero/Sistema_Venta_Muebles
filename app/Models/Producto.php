<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

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


    // M:1 producto-tipoMueble

    public function tipo_mueble(): BelongsTo
    {
        return $this->belongsTo(TipoMueble::class, "id_tipo_mueble");
    }
    // M:M producto-oferta

    public function oferta(): BelongsToMany
    {
        return $this->belongsToMany(Oferta::class, "oferta_producto", "id_producto", "id_oferta");
    }

    // M:M producto-venta

    public function venta(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, "producto_venta", "id_producto", "id_venta")->withPivot('unidades_vendidas_prod', "precio_venta_prod");
    }

    // M:M producto-ofertaComboProducto

    public function oferta_combo_producto()
    {
        // return $this->belongsToMany(OfertaCombo::class, 'oferta_combo_producto', 'id_oferta_combo', 'id_producto')->withPivot('cantidad_producto_combo');
        return $this->belongsToMany(OfertaCombo::class, 'oferta_combo_producto', 'id_producto', 'id_oferta_combo')->withPivot('cantidad_producto_combo');
    }

    // Funciones
    public function getPrecioDeVenta()
    {
        //Revisar si trae la oferta de mayor prioridad y qu esté activa
        return $this->precio_producto*((100-$this->oferta[0]->porcentaje_descuento)/100);
    }

    public function hayStockProducto($unidadesProd)
    {
        $stockDisp = Producto::findOrFail($this->id)->stock;
        return $stockDisp >= $unidadesProd;
    }

    public function reducirStockProducto($unidadesProd)
    {
        DB::table('productos')->where('id', $this->id)->decrement('stock', $unidadesProd);
    }

}
