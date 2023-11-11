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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productos = Producto::paginate(4);
        $combos = array_slice($this->combosActivos("", "", ""), 0, 4);
        return (view("cliente.welcome", compact("productos", "combos")));
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        $enCarrito = Venta::enCarrito('Producto', $id);
        return view('cliente.productos.show', ['producto' => $producto, 'enCarrito' => $enCarrito]);
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
        $tipoMueble =  $request->input('tipoMueble');
        $filtro =  $request->input('filtro');
        $ordenCriterio =  $request->input('ordenCriterio');
        $orden =  $request->input('orden');


        // GET PARA BUSQUEDA EN TODO EL SISTEMA


        // $validated = $request->validate([
        // "name" => ""
        // "tipoMueble" => ""
        // "filtro" => ""
        // "ordenCriterio" => ""
        // "orden" => ""
        // ]);

        if (count($request->all()) < 3) {
            $matchInput = ["discontinuado" => 0];

            $resultados = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy('nombre_producto', 'ASC')->paginate(2);

            $resultados->appends(["name" =>  $name]);

            return view("cliente.productos.index", compact("name", "resultados"));
        }

        // POST PARA HACERLO EN INDEX PRODUCTOS

        $tipoMueble =  $request->input('tipoMueble') === "ext" ? "1" : "2";
        $ordenCriterio = $request->input("ordenCriterio")  === "nombre" ? "nombre_producto" : "precio_producto";
        $matchInput = ['id_tipo_mueble' => $tipoMueble, "discontinuado" => 0];


        if ($request->input('filtro') === "todo") { //PRODUCTOS Y COMBOS
            // $productos = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio, $request->input("orden"))->paginate(2);
            // $combos = $this->combosActivos($name, $ordenCriterio, $request->input("orden"));

            // $resultados = ["productos" => $productos, "combos" => $combos];  

            $resultados = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio, $request->input("orden"))->paginate(2);
        } else if ($request->input('filtro') === "productos") { // PRODUCTOS
            $resultados = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio, $request->input("orden"))->paginate(2);
        } else {  // COMBOS 
            $resultados = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio, $request->input("orden"))->paginate(2);

            // $resultados = $this->combosActivos($name, $ordenCriterio, $request->input("orden"));
        }

        // dd($resultados);

        //  dd($resultados->links());

        return view("cliente.productos.index", compact("name", "tipoMueble", "filtro", "ordenCriterio", "orden", "resultados"));

        //     return view("cliente.productos.index", compact("name", "resultados"));



        // $productos = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy('nombre_producto', 'ASC')->paginate(2);

        // $productos->appends(["name" =>  $name]);

        // return view("cliente.productos.index", compact("name", "productos"));
    }

    function combosActivos($searchTerm, $ordenCriterio, $orden)
    {

        $today = date("Y-m-d");
        $ordenCheck = $orden === "" ? "asc" : $orden;


        // SI HAY TERMINO DE BUSQUEDA 
        if (isset($searchTerm) && $searchTerm !== "") {

            $combos = Oferta::where('ofertas.fecha_inicio_oferta', "<=", $today)->where('ofertas.fecha_fin_oferta', ">=", $today)->whereHas(
                "ofertaCombo",
                function ($query) use ($searchTerm) {
                    $query->where('nombre_combo', 'like', '%' . "$searchTerm" . '%');
                }
            )->get();
        } else {   // SI NO HAY TERMINO
            $combos = Oferta::where('ofertas.fecha_inicio_oferta', "<=", $today)->where('ofertas.fecha_fin_oferta', ">=", $today)->whereHas(
                "ofertaCombo"
            )->get();
        }
        // RETORNA TODAS LAS OFERTAS COMBOS VIGENTES POR FECHA

        /*   */

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
        if ($ordenCriterio !== "") {
            if ($orden  === "asc") {

                if ($ordenCriterio === "nombre_producto") {
                    usort($arrayProductosCombos, function ($a, $b) {
                        return strcmp($a['nombreCombo'], $b['nombreCombo']);
                    });
                } else {
                    usort($arrayProductosCombos, function ($a, $b) {
                        return strcmp($a['precioTotal'], $b['precioTotal']);
                    });
                }
            } else {
                if ($ordenCriterio === "nombre_producto") {

                    usort($arrayProductosCombos, function ($a, $b) {
                        return strcmp($b['nombreCombo'], $a['nombreCombo']);
                    });
                } else {
                    usort($arrayProductosCombos, function ($a, $b) {
                        return strcmp($b['precioTotal'], $a['precioTotal']);
                    });
                }
            }
        } else {
            usort($arrayProductosCombos, function ($a, $b) {
                return strcmp($a['nombreCombo'], $b['nombreCombo']);
            });
        }





        return ($arrayProductosCombos);
    }
}
