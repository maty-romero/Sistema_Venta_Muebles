<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->get();

        // Aquí puedes iterar sobre todas las ventas y crear un array de datos
        $infoVentas = [];

        foreach ($ventas as $venta) {
            $infoVentas[] = [
                'id' => $venta->id,
                'fecha_venta' => $venta->fecha_venta,
                'total_venta' => $venta->monto_final_venta,
                'domicilio_venta' => $venta->domicilio_destino,
                'nombre_cliente' => $venta->cliente->nombre_cliente,
                'tipo_cliente' => $venta->cliente->tipo_cliente,

            ];
        }

        return view("administrador.ventas.index", ['ventas' => $infoVentas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $idCliente)
    {
        if(Venta::verificarStockCarrito()){
            if(Venta::realizarPago()){
                Venta::finalizarVenta($idCliente, $request->codPostal, $request->direccionDestino);
                //Debería devolver la vista del detalle de venta
                return view("cliente.ventas.carrito", ['msj' => 'Todo joya', 'subtotal' => 1]);
            } else {
                return view("cliente.ventas.carrito", ['msj' => 'Pago Joyant', 'subtotal' => Venta::calcularSubtotal()]);
            }
        } else {
            return view("cliente.ventas.carrito", ['msj' => 'Stock Joyant', 'subtotal' => Venta::calcularSubtotal()]);
        }
    }

    public function show(string $id)
    {
        $datos = [];

        // Info de la venta dado un id en general 
        $venta = Venta::select('id', 'fecha_venta', 'monto_final_venta', 'domicilio_destino')
            ->findOrFail($id);

        //formateo de la fecha venta
        $fechaNueva = date("d/m/Y", strtotime($venta->fecha_venta));
        $venta->fecha_venta = $fechaNueva;

        $datos['venta'] = $venta;
        $datos['productos'] = VentaController::getProductosVendidos($venta);
        $datos['combos'] = VentaController::getCombosVendidos($venta);

        return view('cliente.ventas.show', ['datos' => $datos]);
    }

    private static function getProductosVendidos($venta)
    {
        // Productos vendidos con su oferta 
        $productosVenta = $venta->producto;

        $productosArray = [];

        foreach ($productosVenta as $producto) {
            $nombreProducto = $producto->nombre_producto;
            $precioProducto = $producto->precio_producto;
            $unidadesVendidas = $producto->pivot->unidades_vendidas_prod; // Acceso a la tabla pivot 
            $precioVentaProducto = $producto->pivot->precio_venta_prod;

            // Obtengo la oferta vinculada a ese producto_venta (solo 1 para utilizar el modelo)
            $oferta = $producto->oferta->first();

            // Arreglo para cada producto con sus atributos, incluyendo 'porcentaje_descuento' si existe
            $productoInfo = [
                'nombre_producto' => $nombreProducto,
                'precio_producto' => $precioProducto,
                'unidades_vendidas' => $unidadesVendidas,
                'precio_venta' => $precioVentaProducto,
                'porcentaje_descuento' => $oferta ? $oferta->porcentaje_descuento : null,
            ];

            $productosArray[] = $productoInfo;
        }
        return $productosArray;
    }

    private static function getCombosVendidos($venta)
    {
        // Combos vendidos 
        $combosVenta = $venta->ofertaCombo;

        $combosArray = [];

        foreach ($combosVenta as $combo) {
            $nombreCombo = $combo->nombre_combo;
            $unidadesVendidasCombo = $combo->pivot->unidades_vendidas_combo;
            $precioCombo = $combo->pivot->precio_combo; //precio_venta_combo -> luego del descuento

            $productos = $combo->oferta_combo_producto()->get();
            $datos['hola'] = $productos;

            $precioUnitarioCombo = 0.0;

            foreach ($productos as $producto) {
                $cantidadProductoCombo = $producto->pivot->cantidad_producto_combo;
                $precioProducto = $producto->precio_producto;
                $precioUnitarioCombo += $cantidadProductoCombo * $precioProducto;
            }

            // Obtengo la oferta vinculada a ese combo (solo 1 para utilizar el modelo)
            $oferta = $combo->oferta()->first();

            $porcentajeDescuento = $oferta ? $oferta->porcentaje_descuento : null;

            // Arreglo para cada combo con sus atributos, incluyendo 'porcentaje_descuento' si existe
            $comboInfo = [
                'nombre_combo' => $nombreCombo,
                'unidades_vendidas' => $unidadesVendidasCombo,
                'precio_combo_final' => $precioCombo,
                'precio_unitario' => $precioUnitarioCombo,
                'porcentaje_descuento' => $porcentajeDescuento
            ];

            $combosArray[] = $comboInfo;
        }
        return $combosArray;
    }

    public function update(Request $request, string $id)
    {
        //
    }

    // METODO PARA MOSTRAR CARRITO
    public function cart()
    {
        $carrito = Venta::getCarrito();
        $subtotal = Venta::calcularSubtotal();
        return view('cliente.ventas.carrito', ['carrito' => $carrito, 'subtotal' => $subtotal]);
    }

    public function updateCart($id, $tipoItem)
    {
        Venta::agregarAlCarrito($id, $tipoItem);
        return to_route('home');
    }

    public function editCart(FormRequest $r, $tipoItem, $id)
    {
        Venta::editarCantidadCarrito($id, $r->incremento, $tipoItem);
        return to_route('carrito');
    }

    public function removeFromCart($id, $tipoItem)
    {
        Venta::removerDelCarrito($id, $tipoItem);
        return to_route('carrito');
    }

}
