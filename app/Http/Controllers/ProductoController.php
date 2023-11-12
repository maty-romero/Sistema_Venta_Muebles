<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
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

        // FALTAN VALIDACIONES

        $name =  $request->input('name');
        $tipoMueble =  $request->input('tipoMueble') === "int" ?  "2" : "1";
        $filtro =  $request->input('filtro') !== null ? $request->input('filtro') :  "todo";
        $ordenCriterio = $request->input("ordenCriterio")  === "nombre" ? "nombre_producto" : "precio_producto";
        $orden =  $request->input('orden') !== null ? $request->input('orden') :  "asc";
        $matchInput = ['id_tipo_mueble' => $tipoMueble, "discontinuado" => 0];

        // SE NECESITA USAR DB EN ESTE CASO PORQUE ARMO DOS ESTRUCTURAS PRODUCTOS Y COMBOS
        // NECESITO QUE SEAN ARRAYS PARA ORDENARLOS MAS COMODAMENTE

        if ($filtro === "todo") {
            // PRODUCTOS Y COMBOS 
            $combos = $this->combosActivos($name);
            $productos = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio,  $orden)->paginate(2);
            $resultados = array_merge($productos->items(), $combos);
            // ordenamiento
            $resultados = $this->sortArray($resultados, $ordenCriterio, $orden);
            // paginacion
            $resultados = $this->paginate($resultados, 4, $request->input('page'));
            $resultados->appends(["name" => $name, "tipoMueble" => $tipoMueble, "filtro" => $filtro, "ordenCriterio" => $ordenCriterio, "orden" => $orden]);
        } else  if ($filtro === "productos") {
            // PRODUCTOS
            $resultados = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio,  $orden)->paginate(4);
        } else {
            // COMBOS
            $resultados = $this->combosActivos($name);
            $resultados = $this->sortArray($resultados, $ordenCriterio, $orden);
            $resultados = $this->paginate($resultados, 4, $request->input('page'));
        }

        return view("cliente.productos.index", compact("name", "tipoMueble", "filtro", "ordenCriterio", "orden", "resultados"));
    }


    // FUNCION PARA BUSCAR TODOS LOS COMBOS ACTIVOS

    public function combosActivos($searchTerm)
    {

        $today = date("Y-m-d");


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



        return ($arrayProductosCombos);
    }


    public function paginate($items, $perPage, $actualPage)
    {
        $pageStart = $actualPage;
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }

    public function sortArray($array, $ordenCriterio, $orden)
    {
        if ($ordenCriterio !== "") {
            if ($orden  === "asc") {
                if ($ordenCriterio === "nombre_producto") {
                    usort($array, function ($a, $b) {
                        return strcmp(isset($a['nombre_producto']) ? $a['nombre_producto'] : $a['nombreCombo'], isset($b['nombre_producto']) ? $b['nombre_producto'] : $b['nombreCombo']);
                    });
                } else {
                    usort($array, function ($a, $b) {
                        return strcmp(isset($a['precioTotal']) ? $a['precioTotal'] : $a['precio_producto'], isset($b['precioTotal']) ? $b['precioTotal'] : $b['precio_producto']);
                    });
                }
            } else {
                if ($ordenCriterio === "nombre_producto") {

                    usort($array, function ($a, $b) {
                        return strcmp(isset($b['nombre_producto']) ? $b['nombre_producto'] : $b['nombreCombo'], isset($a['nombre_producto']) ? $a['nombre_producto'] : $a['nombreCombo']);
                    });
                } else {
                    usort($array, function ($a, $b) {
                        return strcmp(isset($b['precioTotal']) ? $b['precioTotal'] : $b['precio_producto'], isset($a['precioTotal']) ? $a['precioTotal'] : $a['precio_producto']);
                    });
                }
            }
        } else {
            usort($array, function ($a, $b) {
                return strcmp(isset($a['nombre_producto']) ? $a['nombre_producto'] : $a['nombreCombo'], isset($b['nombre_producto']) ? $b['nombre_producto'] : $b['nombreCombo']);
            });
        }

        return $array;
    }
}
