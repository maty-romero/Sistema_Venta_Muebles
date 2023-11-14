<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ProductoOferta extends Model
{
    use HasFactory;

    // TABLA RELACION

    protected $fillable = ["id_producto", "id_oferta"];
    protected $table = "oferta_producto"; //tabla a referenciar

    public static function crearOfertaUnitaria($productos, $oferta)
    {
        $primero = true;
        foreach($productos as $prod){
            $idProd = (int)explode(".", $prod)[0];
            $ofertaProducto = new ProductoOferta();
            $ofertaProducto->id_producto = $idProd;
            if($primero){
                $ofertaProducto->id_oferta = $oferta->id;
                $primero = false;
            } else {
                $nuevaOferta = $oferta->replicate();
                $nuevaOferta->save();
                $ofertaProducto->id_oferta = $nuevaOferta->id;
            }
            $ofertaProducto->save();
        }
    }
}
