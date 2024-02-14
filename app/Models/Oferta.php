<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Oferta extends Model
{
    use HasFactory, SoftDeletes;
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

    public static function validarOfertaUnitaria(){
        $fechaInicio = request()->input('fechaInicio');
        $fechaFin = request()->input('fechaFin');
        $productos = request()->input('productos');

        foreach ($productos as $prod) {
            $idProd = (int)explode(".", $prod)[0];

            $results = DB::select(
                "SELECT p.id, o.id 
                FROM `productos` AS p 
                INNER JOIN `oferta_producto` AS op ON p.id = op.id_producto
                INNER JOIN `ofertas` AS o ON o.id = op.id_oferta
                WHERE p.id = '$idProd'
                AND (p.deleted_at IS NULL and op.deleted_at IS NULL and o.deleted_at IS NULL)
                    AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                    OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                    OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
                    OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
            );

            if (count($results) > 0) {
                return false;
            }
            return true;
        }
    }

    public function getTipoOferta(){
        if(OfertaTipoMueble::find($this->id)){
            return 'Muebles de '.TipoMueble::find(OfertaTipoMueble::find($this->id)->id_tipo_mueble)->nombre_tipo_mueble;
        } else if(OfertaCombo::find($this->id)){
            return 'Combo '.OfertaCombo::find($this->id)->nombre_combo;
        } else if(OfertaMonto::find($this->id)){
            return 'Por monto';
        }
        return 'Unitaria '.Producto::find(ProductoOferta::where('id_oferta', $this->id)->first()->id_producto)->nombre_producto;
    }
}
