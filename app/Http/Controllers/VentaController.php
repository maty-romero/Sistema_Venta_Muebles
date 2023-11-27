<?php

namespace App\Http\Controllers;

use App\Models\OfertaCombo;
use App\Models\Producto;
use App\Models\Venta;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->paginate(5);
        return view("administrador.ventas.index", compact('ventas'));
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
        //dd($request);
        try{
            $validator = Validator::make($request->all(), [
                'codPostalHidden' => 'required|numeric',
                'direccionDestinoHidden' => 'required'
            ], [
                'codPostalHidden.required' => 'El campo Código Postal es obligatorio.',
                'codPostalHidden.numeric' => 'El campo Código Postal debe ser un valor numérico.',
                'direccionDestinoHidden.required' => 'El campo Domicilio de Destino es obligatorio.'
            ]);
    
            $validator->validate();

            $request = new Request();
            $request->setLaravelSession(session());
            if (Venta::hayStockCarrito()) {
                if (Venta::realizarPago()) {
                    $idVenta = Venta::finalizarVenta($idCliente, request()->codPostalHidden, request()->direccionDestinoHidden);
                    $request->session()->put('ofertaMonto', null);
                    //Retorna el comprobante en pdf de la venta 
                    session()->flash('success', 'Su compra se ha realizada con éxito.');
                    session()->flash('nroComprobante', $idVenta);
                    return to_route('home'); 
                } else {
                    $msj = 'Error al procesar el pago. Intente de nuevo.';
                }
            } else {
                $msj = 'Error al realizar la compra. Algunos de los productos de tu carrito no tienen stock suficiente.';
            }
            $ofertaMonto = $request->session()->get('ofertaMonto');
            if (!isset($ofertaMonto)) {
                $ofertaMonto = null;
            }
            session()->flash('msj', $msj);
            return view("cliente.ventas.carrito", ['msj' => $msj, 'subtotal' => Venta::calcularSubtotal(), 'carrito' => Venta::getCarrito(), 'ofertaMonto' => $ofertaMonto]);

        } catch (ValidationException $e) {
            $ofertaMonto = $request->session()->get('ofertaMonto');
            if (!isset($ofertaMonto)) {
                $ofertaMonto = null;
            }
            $msj = 'Error al realizar la compra. La información de envío está incompleta.';
            session()->flash('msj', $msj); 
            return redirect()->route('carrito', [
                'subtotal' => Venta::calcularSubtotal(),
                'carrito' => Venta::getCarrito(),
                'ofertaMonto' => $ofertaMonto,
            ])->withErrors($e->validator->errors())->withInput();
        }
        
    }

    public function show(string $idVenta)
    {
        // Info de la venta dado un id en general 
        $venta = Venta::with('ofertaMonto.oferta')->findOrFail($idVenta);
        //$venta = $venta->ofertaMonto->oferta; 

        if (Auth::user()->cliente->id_usuario_cliente == $venta->id_usuario_cliente) {
            $datos = [];
            //formateo de la fecha venta
            $fechaNueva = date("d/m/Y", strtotime($venta->fecha_venta));
            $venta->fecha_venta = $fechaNueva;

            $datos['venta'] = $venta;
            $datos['productos'] = VentaController::getProductosVendidos($venta);
            $datos['combos'] = VentaController::getCombosVendidos($venta);

            return view('cliente.ventas.show', ['datos' => $datos]);
        }

        //No hay coincidencia 
        return Redirect::route('home');
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
        $request = new Request();
        $request->setLaravelSession(session());
        $ofertaMonto = $request->session()->get('ofertaMonto');
        return view('cliente.ventas.carrito', ['carrito' => $carrito, 'subtotal' => $subtotal, 'ofertaMonto' => $ofertaMonto]);
    }

    public function updateCart($tipoItem, $id)
    {
        Venta::agregarAlCarrito($tipoItem, $id);
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


    public function searchVenta(Request $request)
    {
        $name = $request->input("name");
        $orden = $request->input("ordenamiento");
        $direccion =  $request->input("direccion_orden");

        if ($orden === "nombre_cliente") {
            $ventas  = Venta::whereHas(
                "cliente",
                function ($query) use ($name, $direccion) {
                    $query->where('nombre_cliente', 'like', '%' . "$name" . '%')->orderBy("nombre_cliente", $direccion);
                }
            )->paginate(5);
        } else {
            $ventas  = Venta::whereHas(
                "cliente",
                function ($query) use ($name) {
                    $query->where('nombre_cliente', 'like', '%' . "$name" . '%');
                }
            )->orderBy($orden, $direccion)->paginate(5);
        }



        $input = $request->input();
        $ventas->appends(["ordenamiento" => $orden, "direccion_orden" => $direccion, "name" => $name]);

        return view("administrador.ventas.index", compact('ventas', "input"));
    }
}
