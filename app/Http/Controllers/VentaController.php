<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        $datos = [];  
        
        // Info de la venta en general 
        $venta = Venta::select('id','fecha_venta', 'monto_final_venta', 'domicilio_destino')
            ->findOrFail($id);

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

        $combosVenta = $venta->ofertaCombo;

        $combosArray = [];

        foreach ($combosVenta as $combo) {
            $nombreCombo = $combo->nombre_combo;
            $unidadesVendidasCombo = $combo->pivot->unidades_vendidas_combo;
            $precioCombo = $combo->pivot->precio_combo;

            // Obtengo la oferta vinculada a ese combo (solo 1 para utilizar el modelo)
            $oferta = $combo->oferta()->first();

            $porcentajeDescuento = $oferta ? $oferta->porcentaje_descuento : null;

            // Arreglo para cada combo con sus atributos, incluyendo 'porcentaje_descuento' si existe
            $comboInfo = [
                'nombre_combo' => $nombreCombo,
                'unidades_vendidas' => $unidadesVendidasCombo,
                'precio_combo' => $precioCombo,
                'porcentaje_descuento' => $porcentajeDescuento
            ];

            $combosArray[] = $comboInfo;
        }

        $datos['venta'] = $venta; 
        $datos['productos'] = $productosArray;
        $datos['combos'] = $combosArray;

        return view('cliente.ventas.show', ['datos' => $datos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    // METODO PARA MOSTRAR CARRITO
}
