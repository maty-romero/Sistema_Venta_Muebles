<?php

namespace App\Http\Controllers;

use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoOferta;
use App\Models\ProductoVendido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(4);

        $combos = array_slice($this->combosActivos(), 0, 4);
        return (view("cliente.welcome", compact("productos", "combos")));
    }




    // $temp = OfertaCombo::fetchCombo();

    // dd($temp);


    //     echo $producto->oferta;
    // $producto = new Producto();
    // //Producto::(1)->oferta()->get();
    // $productos = Producto::all();
    // //$ofertas = array();
    // $producto_oferta = array();
    // foreach($productos as $producto){
    //     //$producto_oferta[] = $producto;
    //     $producto_oferta[] = $producto;  
    //     $producto_oferta[] = $producto->oferta_combo_producto;
    //     //echo $producto->oferta;
    // } 
    // return $producto_oferta;
    // $combo = ComboVendido::where("id_oferta_combo", 7)->first();
    // echo $combo->venta;

    // $productoVenta = ProductoVendido::where("id_venta", 2)->where("id_producto", 9)->first();
    // echo $productoVenta->oferta;
    // $oferta = Oferta::find(1);
    // echo $oferta->ofertaProductoVendido;

    // $ofertaMueble = OfertaTipoMueble::find(7);
    // echo $ofertaMueble->tipoMueble;

    // $cliente = Cliente::find(1);
    // echo $cliente->usuario;


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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        $enCarrito = Venta::productoEnCarrito($id);
        return view('cliente/productos/show', ['producto' => $producto, 'enCarrito' => $enCarrito]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

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

    public function search(Request $request)
    {
        $name =  $request->input('name');

        $matchInput = ['id_tipo_mueble' => 2, "discontinuado" => 0];

        $productos = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy('nombre_producto', 'ASC')->paginate(2);

        $productos->appends(["name" =>  $name]);

        return view("cliente.productos.index", compact("name", "productos"));
    }

    public function testFetchOferta()
    {

        // $producto = Producto::whereHas(
        //     "oferta_combo_producto",
        //     function ($query) {
        //         $query->where("cantidad_producto_combo", ">", 50);
        //     }
        // )->get();

        // // CONSULTA PARA TRAER PRODUCTOS CON COMBO ACTIVOS EN EL DIA DE HOY
        // $productoOfertasCombos = Producto::where("discontinuado", 0)->where("stock", ">=", 1)->whereHas("oferta", function ($query) {
        //     $todayDate = date('Y-m-d'); // dia de hoy
        //     $query->where('ofertas.fecha_inicio_oferta', "<=", "2024-09-23");
        //     $query->where('ofertas.fecha_fin_oferta', ">=", "2024-09-23");
        // })->whereHas(
        //     "oferta_combo_producto"
        // )->get();


        // // CONSULTA PARA TRAER PRODUCTOS CON OFERTAS UNITARIAS SIN COMBO ACTIVAS EN EL DIA DE HOY
        // $productoOfertasUnitarias = Producto::where("discontinuado", 0)->where("stock", ">=", 1)->whereHas("oferta", function ($query) {
        //     $todayDate = date('Y-m-d'); // dia de hoy
        //     $query->where('ofertas.fecha_inicio_oferta', "<=", "2024-09-23");
        //     $query->where('ofertas.fecha_fin_oferta', ">=", "2024-09-23");
        // })->whereDoesntHave(
        //     "oferta_combo_producto"
        // )->get();

        // RETORNA TODAS LAS OFERTAS COMBOS VIGENTES POR FECHA

        $combos = Oferta::where('ofertas.fecha_inicio_oferta', "<=", "2024-09-23")->where('ofertas.fecha_fin_oferta', ">=", "2024-09-23")->whereHas(
            "ofertaCombo"
        )->get();


        $arrayProductosCombos = [];

        $arrayCHECKTEMP = [];

        foreach ($combos as $combo) {
            // CHECK PRODUCTOS CON STOCK Y NO DISCONTINUADOS

            // ID´S PRODUCTOS DEL COMBO (SIN COMPROBAR)
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

                foreach ($idProductosCheck as $producto) {
                    $infoProducto = Producto::find($producto->id);

                    $producto = [
                        'producto' => $infoProducto,
                        'stockCombo' => $producto->cantidad_producto_combo,
                    ];
                    array_push($tempProductoArray, $producto);
                }
                $comboInfo = OfertaCombo::find($combo->id);
                $comboCompleto = [
                    "infoContenidoCombo" => $tempProductoArray,
                    "nombreCombo" => $comboInfo->nombre_combo,
                ];

                array_push($arrayProductosCombos, $comboCompleto);
            }
        }


        usort($arrayProductosCombos, function ($a, $b) {
            return strcmp($a['nombreCombo'], $b['nombreCombo']);
        });

        return $arrayProductosCombos;
    }


    function combosActivos()
    {

        // RETORNA TODAS LAS OFERTAS COMBOS VIGENTES POR FECHA

        $combos = Oferta::where('ofertas.fecha_inicio_oferta', "<=", "2024-09-23")->where('ofertas.fecha_fin_oferta', ">=", "2024-09-23")->whereHas(
            "ofertaCombo"
        )->get();


        $arrayProductosCombos = [];

        $arrayCHECKTEMP = [];

        foreach ($combos as $combo) {
            // CHECK PRODUCTOS CON STOCK Y NO DISCONTINUADOS

            // ID´S PRODUCTOS DEL COMBO (SIN COMPROBAR)
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
                    "idCombo" => $combo->id,
                    "infoContenidoCombo" => $tempProductoArray,
                    "nombreCombo" => $comboInfo->nombre_combo,
                    "descuentoCombo" => $combo->porcentaje_descuento,
                    "precioTotal" => $precioTotal
                ];

                array_push($arrayProductosCombos, $comboCompleto);
            }
        }


        usort($arrayProductosCombos, function ($a, $b) {
            return strcmp($a['nombreCombo'], $b['nombreCombo']);
        });

        return ($arrayProductosCombos);
    }
}
