<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OfertaCombo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "oferta_combo"; //tabla a referenciar
    protected $primaryKey = 'id_oferta_combo';
    protected $fillable = [
        "nombre_combo",
        "imagenURL",
    ];
    


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

    // METODO DE RECOLLECCION DE COMBOS

    public static function fetchCombo()
    {
        $arrayCombos = [];
        $productosCombos = [];
        $idOfertaCombo = DB::select("SELECT id_oferta_combo FROM oferta_combo_producto WHERE deleted_at IS NULL GROUP BY oferta_combo_producto.id_oferta_combo ");

        foreach ($idOfertaCombo as $ofertaCombo) {

            $comboRow = DB::select("SELECT * FROM oferta_combo_producto WHERE id_oferta_combo= $ofertaCombo->id_oferta_combo");

            foreach ($comboRow as $idCombo) {
                $producto = Producto::find($idCombo->id_producto);
                array_push($productosCombos, $producto);
            }
            array_push($arrayCombos, $productosCombos);

            $productosCombos = [];
        }

        return $arrayCombos;
    }

    public static function crearCombo($productos, $idOferta)
    {
        $ofertaCombo = new OfertaCombo();
        $ofertaCombo->id_oferta_combo = $idOferta;
        $ofertaCombo->nombre_combo = request()->input('nombreCombo');

        $fileImg = $_FILES["imagenCombo"];
        move_uploaded_file($fileImg["tmp_name"], public_path('images/combos/' . $idOferta . basename($fileImg["name"])));
        $ofertaCombo->imagenURL = 'images/combos/' . $idOferta . basename($fileImg["name"]);

        $ofertaCombo->save();

        foreach ($productos as $prod) {
            $idProd = (int)explode(".", $prod)[0];
            $cant = (int)explode("x", $prod)[count(explode("x", $prod)) - 1];
            $detalleCombo = new DetalleCombo();
            $detalleCombo->id_producto = $idProd;
            $detalleCombo->id_oferta_combo = $idOferta;
            $detalleCombo->cantidad_producto_combo = $cant;
            $detalleCombo->save();
        }
    }

    public function getPrecioComboSinDescuento()
    {
        $sum = 0;
        foreach ($this->oferta_combo_producto as $prod) {
            $sum += $prod->precio_producto * $prod->pivot->cantidad_producto_combo;
        }
        return $sum;
    }

    public function getPrecioCombo()
    {
        return $this->getPrecioComboSinDescuento() * (1 - $this->oferta->porcentaje_descuento / 100);
    }

    public function hayStockCombo($unidadesCombo)
    {
        foreach ($this->oferta_combo_producto as $prod) {
            $totalUnidades = $unidadesCombo * $prod->pivot->cantidad_producto_combo;
            if (!$prod->hayStockProducto($totalUnidades)) {
                return false;
            }
        }
        return true;
    }

    public function reducirStockCombo($unidadesCombo)
    {
        foreach ($this->oferta_combo_producto as $comboProd) {
            $totalUnidades = $unidadesCombo * $comboProd->pivot->cantidad_producto_combo;
            $comboProd->reducirStockProducto($totalUnidades);
        }
    }

    public function unidadesMaximas()
    {
        $maximoTotal = 100000;
        foreach ($this->oferta_combo_producto as $prod) {
            $maximoItem = $prod->stock / $prod->pivot->cantidad_producto_combo;
            if (!isset($maximoTotal) || $maximoTotal > $maximoItem) {
                $maximoTotal = $maximoItem;
            }
        }
        return (int)$maximoTotal;
    }

    public function comboActivo()
    {
        foreach ($this->oferta_combo_producto as $prod) {
            if ($prod->discontinuado == 1 || $prod->stock <= 0) {
                return false;
            }
        }
        return true;
    }

    public static function validarCombo(){

        $fechaInicio = request()->input('fechaInicio');
        $fechaFin = request()->input('fechaFin');
        $productos = request()->input('productos');

        $comboSimilar = true;
        foreach ($productos as $prod) {
            $idProd = (int)explode(".", $prod)[0];
            $cant = (int)explode("x", $prod)[count(explode("x", $prod)) - 1];

            $results = DB::select(
                "SELECT o.id, o.fecha_inicio_oferta, o.fecha_fin_oferta
                FROM `ofertas` AS o
                INNER JOIN `oferta_combo_producto` AS cp ON o.id = cp.id_oferta_combo
                WHERE cp.id_producto = '$idProd' AND cp.cantidad_producto_combo = '$cant' 
                AND  (o.deleted_at IS NULL and cp.deleted_at IS NULL)
                AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
                OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
            );

            if (count($results) <= 0) {
                $comboSimilar = false;
            }
        }
        if ($comboSimilar) {
            return false;
        }
        return true;
    }
}
