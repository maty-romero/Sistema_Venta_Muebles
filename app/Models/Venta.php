<?php

namespace App\Models;

use Illuminate\http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Venta extends Model
{
    use HasFactory;
    //campos solicitados al momento de enviar el request
    protected $fillable = [
        "fecha_venta",
        "monto_final_venta",
        "nro_pago",
        "codigo_postal_destino",
        "domicilio_destino",
        "id_usuario_cliente",
        "id_oferta_monto"
    ];
    protected $table = "ventas"; //tabla a referenciar

    //Relaciones 

    // M:M producto-venta

    public function producto(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, "producto_venta", "id_venta", "id_producto")->withPivot('unidades_vendidas_prod', "precio_venta_prod");
    }

    // M:M ofertaCombo-Ventas

    public function ofertaCombo(): BelongsToMany
    {
        return $this->belongsToMany(OfertaCombo::class, "oferta_combo_venta", "id_venta", "id_oferta_combo")->withPivot('unidades_vendidas_combo');;
    }

    // M:1 venta-ofertaMonto

    public function ofertaMonto(): BelongsTo
    {
        return $this->belongsTo(OfertaMonto::class, "id_oferta_monto");
    }

    // M a 1 Clientes

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_usuario_cliente');
    }

    public static function getProductosCarrito(){
        $request = new Request();
        $request->setLaravelSession(session());
        $carrito = $request->session()->get('carrito');
        $productos = array();
        if(isset($carrito)){
            foreach ($carrito as $id) {
              $productos[] = Producto::findOrFail($id);
            }
        }
        return $productos;
    }

    public static function agregarAlCarrito($idProd){
        $request = new Request();
        $request->setLaravelSession(session());
        $carrito = $request->session()->get('carrito');
        $carrito[] = $idProd;
        $request->session()->put('carrito', $carrito);
    }

}
