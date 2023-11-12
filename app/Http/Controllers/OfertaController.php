<?php

namespace App\Http\Controllers;


use App\Models\OfertaCombo;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Oferta;
use App\Models\TipoMueble;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OfertaController extends Controller
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
        $productos = Producto::all();
        $tiposProducto = TipoMueble::all();
        return view('administrador.ofertas.create', ['productos' => $productos, 'tiposProducto' => $tiposProducto]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Oferta::crearOferta();
        return to_route('administrador_ofertas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $combo = $this->searchComboById($id);


        // $combo = OfertaCombo::findOrFail($id);
        // $enCarrito = Venta::enCarrito('Combo', $id);


        return view('cliente/combo/show', ['combo' => $combo[0], 'enCarrito' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    // 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function searchComboById(string $id)
    {
        $today = date("Y-m-d");
        $combo = Oferta::where("id", $id)->where('fecha_inicio_oferta', "<=", $today)->where('fecha_fin_oferta', ">=", $today)->get();
        $combo = $combo[0];
        //->whereHas("ofertaCombo")


        $arrayProductosCombos = [];

        $arrayCHECKTEMP = [];

        $idProductos = DB::select("select id_producto from oferta_combo_producto where id_oferta_combo = '$combo->id'");

        // ID´S PRODUCTOS DEL COMBO (CON COMPROBACION STOCK/DISCONTINUO)
        $idProductosCheck = DB::select("    
        SELECT id,cantidad_producto_combo FROM productos LEFT JOIN oferta_combo_producto ON productos.id = oferta_combo_producto.id_producto
        WHERE (discontinuado=0 AND stock>=oferta_combo_producto.cantidad_producto_combo) AND (id_oferta_combo = '$combo->id')
        ");

        // obtencion de combos con productos y stock validos
        $tempProductoArray = [];

        if (count($idProductos) === count($idProductosCheck) && count($idProductos) > 0) {

            array_push($arrayCHECKTEMP, $combo->id);

            $precioTotal = 0;
            foreach ($idProductosCheck as $producto) {
                $infoProducto = Producto::find($producto->id);


                $productoArray = [
                    'producto' => $infoProducto,
                    'cantidadCombo' => $producto->cantidad_producto_combo,
                ];
                $precioTotal +=  $infoProducto->precio_producto * $producto->cantidad_producto_combo;
                array_push($tempProductoArray, $productoArray);
            }
            $comboInfo = OfertaCombo::find($combo->id);
            $comboCompleto = [
                "id_combo" => $combo->id,
                "info_contenido_combo" => $tempProductoArray,
                "nombre_combo" => $comboInfo->nombre_combo,
                "descuento_combo" => $combo->porcentaje_descuento,
                "precio_total" => $precioTotal
            ];

            array_push($arrayProductosCombos, $comboCompleto);
        }

        return ($arrayProductosCombos);
    }
}
