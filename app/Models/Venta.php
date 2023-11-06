<?php

namespace App\Models;

use Illuminate\http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use stdClass;

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
        return $this->belongsToMany(OfertaCombo::class, "oferta_combo_venta", "id_venta", "id_oferta_combo")->withPivot('unidades_vendidas_combo', 'precio_combo');;
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

    public static function calcularSubtotal()
    {
        $subtotal = 0;
        //Subtotal del carrito
        if($carrito = Venta::getCarrito()){
            foreach($carrito as $item) {
                $subtotal += $item->producto->getPrecioDeVenta() * $item->unidades;        
            }
        }

        return $subtotal;
    }

    public static function getCarrito()
    {
        $request = new Request();
        $request->setLaravelSession(session());
        $carrito = $request->session()->get('carrito');
        return $carrito;
    }

    public static function productoEnCarrito($idProd)
    {
        if($carrito = Venta::getCarrito()){
            foreach($carrito as $item) {
                if($item->producto->id == $idProd){
                    return true;
                }
            }
        }
        return false;
    }

    public static function agregarAlCarrito($idProd)
    {
        $request = new Request();
        $request->setLaravelSession(session());
        $carrito = $request->session()->get('carrito');

        $itemVenta = new stdClass();
        $itemVenta->unidades = request()->input('unidadesProducto');;
        $itemVenta->producto = Producto::findOrFail($idProd);

        $carrito[] = $itemVenta;
        $request->session()->put('carrito', $carrito);
    }

    public static function editarCantidadCarrito($idProd, $operacion)
    {
        $request = new Request();
        $request->setLaravelSession(session());
        $carrito = $request->session()->get('carrito');

        foreach ($carrito as $item) {
            if ($item->producto->id == $idProd) {
                if ($operacion == '+') {
                    $item->unidades++;
                } else {
                    if ($item->unidades > 1) {
                        $item->unidades--;
                    }
                }
            }
        }
    }

    public static function removerDelCarrito($idProd)
    {
        $request = new Request();
        $request->setLaravelSession(session());

        $carrito = $request->session()->get('carrito');
        $carrito2 = array();
        foreach ($carrito as $item) {
            if ($item->producto->id != $idProd) {
                $carrito2[] = $item;
            }
        }
        $request->session()->put('carrito', $carrito2);
    }
}
