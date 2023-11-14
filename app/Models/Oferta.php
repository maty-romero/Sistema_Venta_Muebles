<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Validator;

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

    // 1:M oferta-productoVendido

    public function ofertaProductoVendido(): hasMany
    {
        return $this->hasMany(ProductoVendido::class, "id_oferta");
    }

    public static function crearOferta(){
        $oferta = new Oferta();
        $oferta->fecha_inicio_oferta = request()->input('fechaInicio');
        $oferta->fecha_fin_oferta = request()->input('fechaFin');
        $oferta->porcentaje_descuento = request()->input('descuento');
        $oferta->save();

        switch (request()->input('tipoOferta')) {
            case 'unitaria':
                $productos = request()->input('productos');
                ProductoOferta::crearOfertaUnitaria($productos, $oferta);
                break;
            case 'monto':
                OfertaMonto::crearOfertaMonto($oferta->id);
                break;
            case 'combo':
                $productos = request()->input('productos');
                OfertaCombo::crearCombo($productos, $oferta->id);
                break;
            case 'tipo':
                OfertaTipoMueble::crearOfertaTipo($oferta->id);
                break;
            default:
                break;
        };
    }
}
