<?php

namespace App\Models;

use Illuminate\http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Venta extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->belongsTo(Cliente::class, 'id_usuario_cliente')->withTrashed();
    }

    public static function calcularSubtotal()
    {
        $subtotal = 0;
        //Subtotal del carrito
        if ($carrito = Venta::getCarrito()) {
            foreach ($carrito as $item) {
                if ($item->tipoItem == 'Producto') {
                    $subtotal += $item->elemento->getPrecioDeVenta() * $item->unidades;
                } else {
                    $subtotal += $item->elemento->getPrecioCombo() * $item->unidades;
                }
            }
            $ofertaMonto = OfertaMonto::getOfertaMonto($subtotal);
            $request = new Request();
            $request->setLaravelSession(session());
            $request->session()->put('ofertaMonto', $ofertaMonto);
            /*
            $descuento = 0;
            if (isset($ofertaMonto)) {
                $descuento = $ofertaMonto->porcentaje_descuento;
            }
            $subtotal = $subtotal * (1 - $descuento / 100);
            */
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

    public static function enCarrito($tipoItem, $id)
    {
        // tipoItem = Producto o Combo
        if ($carrito = Venta::getCarrito()) {
            foreach ($carrito as $item) {
                if ($tipoItem == $item->tipoItem) {
                    if (($tipoItem == 'Producto' && $item->elemento->id == $id) || ($tipoItem == 'Combo' && $item->elemento->id_oferta_combo == $id)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function agregarAlCarrito($tipoItem, $id)
    {
        $request = new Request();
        $request->setLaravelSession(session());
        $carrito = $request->session()->get('carrito');

        $itemVenta = new stdClass();
        if ($tipoItem == 'Producto') {
            $itemVenta->unidades = request()->input('unidadesProducto');
            $itemVenta->elemento = Producto::findOrFail($id);
        } else if ($tipoItem == 'Combo') {
            $itemVenta->unidades = request()->input('unidadesCombo');
            $itemVenta->elemento = OfertaCombo::findOrFail($id);
        }
        $itemVenta->tipoItem = $tipoItem;
        $carrito[] = $itemVenta;
        $request->session()->put('carrito', $carrito);
    }

    public static function editarCantidadCarrito($id, $operacion, $tipoItem)
    {
        $carrito = Venta::getCarrito();
        foreach ($carrito as $item) {
            if ($tipoItem == $item->tipoItem) {
                if (($tipoItem == 'Producto' && $item->elemento->id == $id) || ($tipoItem == 'Combo' && $item->elemento->id_oferta_combo == $id)) {
                    if ($operacion == '+') {
                        if ($item->tipoItem == 'Producto' && $item->elemento->hayStockProducto($item->unidades + 1)) {
                            $item->unidades++;
                        } else if ($item->tipoItem == 'Combo' && $item->elemento->hayStockCombo($item->unidades + 1)) {
                            $item->unidades++;
                        }
                    } else {
                        if ($item->unidades > 1) {
                            $item->unidades--;
                        }
                    }
                }
            }
        }
    }

    public static function removerDelCarrito($tipoItem, $id)
    {
        $request = new Request();
        $request->setLaravelSession(session());

        $carrito = Venta::getCarrito();
        $carrito2 = array();

        foreach ($carrito as $item) {
            if ($tipoItem != $item->tipoItem) {
                $carrito2[] = $item;
            } else if ($tipoItem == 'Producto') {
                if ($id != $item->elemento->id) {
                    $carrito2[] = $item;
                }
            } else {
                if ($id != $item->elemento->id_oferta_combo) {
                    $carrito2[] = $item;
                }
            }
        }
        $request->session()->put('carrito', $carrito2);
    }

    public static function hayStockCarrito()
    {
        $carrito = Venta::getCarrito();
        foreach ($carrito as $item) {
            if ($item->tipoItem == 'Producto') {
                if (!$item->elemento->hayStockProducto($item->unidades)) {
                    return false;
                }
            } else if ($item->tipoItem == 'Combo') {
                if (!$item->elemento->hayStockCombo($item->unidades)) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function finalizarVenta($idCliente, $codPostal, $direccionDestino)
    {
        $request = new Request();
        $request->setLaravelSession(session());
        $ofertaMonto = $request->session()->get('ofertaMonto');
        $carrito = Venta::getCarrito();

        //Guardar venta
        $venta = new Venta;
        $venta->fecha_venta = now('GMT-3');
        $venta->monto_final_venta = Venta::calcularSubtotal();
        $venta->nro_pago = rand(1, 100000); //Al ser simulado se genera un random
        $venta->codigo_postal_destino = $codPostal;
        $venta->domicilio_destino = $direccionDestino;
        $venta->id_usuario_cliente = $idCliente;
        $venta->id_oferta_monto = (isset($ofertaMonto)) ? $ofertaMonto->id : null;
        $venta->save();

        //Guardar combos vendidos y productos vendidos
        foreach ($carrito as $item) {
            if ($item->tipoItem == 'Combo') {
                $combo = new ComboVendido();
                $combo->id_venta = $venta->id;
                $combo->id_oferta_combo = $item->elemento->id_oferta_combo;
                $combo->unidades_vendidas_combo = $item->unidades;
                $combo->precio_combo = $item->elemento->getPrecioCombo();
                $combo->save();
                //Actualizar stock del combo
                $item->elemento->reducirStockCombo($item->unidades);
            } else if ($item->tipoItem == 'Producto') {
                $producto = new ProductoVendido();
                $producto->id_venta = $venta->id;
                $producto->id_producto = $item->elemento->id;
                $producto->unidades_vendidas_prod = $item->unidades;
                $producto->id_oferta = isset($item->elemento->oferta[0]->id) ? $item->elemento->oferta[0]->id : null;
                $producto->precio_venta_prod = $item->elemento->getPrecioDeVenta();
                $producto->save();
                //Actualizar stock del producto
                $item->elemento->reducirStockProducto($item->unidades);
            }
        }

        //Limpia el carrito
        $request = new Request();
        $request->setLaravelSession(session());
        $request->session()->put('carrito', array());

        return $venta->id;
    }

    private function actualizarStockVendido()
    {
    }

    public static function realizarPago()
    {   //Simula la aceptación o no del pago
        //return true;
        return rand(0, 1);
    }
}
