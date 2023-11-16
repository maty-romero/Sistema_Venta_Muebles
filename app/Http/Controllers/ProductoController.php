<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
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
        $productos = Producto::where("discontinuado", 0)->where("stock", ">=", 1)->paginate(4);
        $combos = array_slice($this->combosActivos("", "", ""), 0, 4);
        return (view("cliente.welcome", compact("productos", "combos")));
    }

    public function index_adm()
    {
        $products = Producto::with('tipo_mueble')->paginate(5);
        return (view("administrador.productos.index", compact('products')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("administrador.productos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
        $fileImg = $_FILES["imagenProd"];
        $imagenURL = 'images/combos/'.basename($fileImg["name"]);

        move_uploaded_file($fileImg["tmp_name"], public_path('imagenURL'));

            $producto = Producto::create([
                'nombre_producto' => $request->input('nombre_producto'),
                'descripcion' => $request->input('descripcion'),
                'stock' => $request->input('stock'),
                'precio_producto' => $request->input('precio_producto'),
                'id_tipo_mueble' => $request->input('id_tipo_mueble'),
                'largo' => $request->input('largo'),
                'ancho' => $request->input('ancho'),
                'alto' => $request->input('alto'),
                'material' => $request->input('material'),
                'imagenURL' => $imagenURL
            ]);
            $producto->save();

            session()->flash('success', 'El producto ha sido creado exitosamente');
        } else {
            session()->flash('error', 'Ha ocurrido un error al crear el producto');
        }

              
        return redirect()->back();
    }

    private static function getRandomUnsplashImageUrl() {
        $imageUrls = [
            'https://images.unsplash.com/photo-1540574163026-643ea20ade25?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1549187774-b4e9b0445b41?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ];
    
        // Seleccionar una URL al azar
        $randomImageUrl = $imageUrls[array_rand($imageUrls)];
    
        return $randomImageUrl;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        if ($producto->discontinuado == 0 && $producto->stock > 0) {
            $enCarrito = Venta::enCarrito('Producto', $id);
            return view('cliente.productos.show', ['producto' => $producto, 'enCarrito' => $enCarrito]);
        }
        return to_route('home');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('administrador.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idProducto)
    {
        $validated = $request->validate([
            'nombreProducto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cmbTipoMueble' => 'required', 
            'alto' => 'required|numeric|min:0',
            'largo' => 'required|numeric|min:0',
            'ancho' => 'required|numeric|min:0',
            'cmbmaterialMueble' => 'required',
        ]);
        

        if ($validated) {

            $producto = Producto::find($idProducto);

            $producto->update([
                'nombre_producto' => $request->input('nombreProducto'),
                'descripcion' => $request->input('descripcion'),
                'id_tipo_mueble' => $request->input('cmbTipoMueble'),
                'largo' => $request->input('largo'),
                'ancho' => $request->input('ancho'),
                'alto' => $request->input('alto'),
                'material' => $request->input('cmbMaterialMueble'),
            ]);

            $producto->save();
            session()->flash('success_producto', 'El producto ha sido modificado exitosamente');
        } else {
            session()->flash('error_producto', 'Ha ocurrido un error al editar el producto');
        }
        return redirect()->back();
    }

    public function update_stock_producto(Request $request, $idProducto){
        try {
            $request->validate([
                'stock' => 'required|min:1|numeric',
                'precio' => 'required|numeric|min:0',
            ]);
            

            $producto = Producto::find($idProducto);
            $nuevoStock = $producto->stock + $request->input('stock');
            $nuevoPrecio = $request->input('precio');
            $producto->update([
                'stock' => $nuevoStock,
                'precio' => $nuevoPrecio
            ]);
            return redirect()->back()->with('success_stock_precio', 'Se ha actualizado stock y/o precio exitosamente');

       } catch (\Exception $e) {
            return redirect()->back()->with('error_stock_precio', 'No se ha podido actualizar stock y/o precio: ' . $e->getMessage());  
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('administrador_create_producto');
    }

    public function search(Request $request)
    {

        // FALTAN VALIDACIONES
        $name =  $request->input('name');
        $tipoMueble =  $request->input('tipoMueble') !== null ? $request->input('tipoMueble') :  1;
        $filtro =  $request->input('filtro') !== null ? $request->input('filtro') :  "todo";
        $ordenCriterio = $request->input("ordenCriterio")  === "nombre_producto" ? "nombre_producto" : "precio_producto";
        $orden =  $request->input('orden') !== null ? $request->input('orden') :  "asc";
        $matchInput = ['id_tipo_mueble' => $tipoMueble, "discontinuado" => 0];

        // SE NECESITA USAR DB EN ESTE CASO PORQUE ARMO DOS ESTRUCTURAS PRODUCTOS Y COMBOS
        // NECESITO QUE SEAN ARRAYS PARA ORDENARLOS MAS COMODAMENTE

        if ($filtro === "todo" || $filtro === null) {

            // PRODUCTOS Y COMBOS 
            $combos = $this->combosActivos($name);
            $productos = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio, $orden)->get();
            $resultados = array_merge($productos->all(), $combos);
            $resultados = $this->sortArray($resultados, $ordenCriterio, $orden);

            // paginacion
        } else  if ($filtro === "productos") {
            // PRODUCTOS
            $resultados = Producto::where($matchInput)->where('nombre_producto', 'like', '%' .   $name  . '%')->where("stock", ">=", 1)->orderBy($ordenCriterio,  $orden)->get();
            $resultados = $resultados->all();
        } else {
            // COMBOS
            $resultados = $this->combosActivos($name);
            $resultados = $this->sortArray($resultados, $ordenCriterio, $orden);
        }

        $resultados = $this->paginate($resultados, 4, $request->input('page') === null ? 1 : $request->input('page'));
        $resultados->appends(["name" => $name, "tipoMueble" => $tipoMueble, "filtro" => $filtro, "ordenCriterio" => $ordenCriterio, "orden" => $orden]);

        //dd(empty($resultados->items()));

        return view("cliente.productos.index", compact("name", "tipoMueble", "filtro", "ordenCriterio", "orden", "resultados"));
    }

    // FUNCION PARA BUSCAR TODOS LOS COMBOS ACTIVOS
    public function combosActivos($searchTerm)
    {
        $today = date("Y-m-d");

        // SI HAY TERMINO DE BUSQUEDA 
        if (isset($searchTerm) && $searchTerm !== "") {

            $combos = Oferta::where('ofertas.fecha_inicio_oferta', "<=", $today)->where('ofertas.fecha_fin_oferta', ">=", $today)->where("porcentaje_descuento", ">", 0)->whereHas(
                "ofertaCombo",
                function ($query) use ($searchTerm) {
                    $query->where('nombre_combo', 'like', '%' . "$searchTerm" . '%');
                }
            )->get();
        } else {   // SI NO HAY TERMINO
            $combos = Oferta::where('ofertas.fecha_inicio_oferta', "<=", $today)->where('ofertas.fecha_fin_oferta', ">=", $today)->where("porcentaje_descuento", ">", 0)->whereHas(
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

    public function updateStock(Request $request, Producto $producto)
    {
        $producto->stock += $request->input('stock');
        $producto->precio_producto = $request->input('precio');
        $producto->update();
        return redirect()->route('administrador_edit_producto', $producto);
    }

    public function searchProducto(Request $request)
    {
        $name = $request->input("name");
        $orden = $request->input("ordenamiento");
        $direccion = $request->input("direccion_orden");
        $input = $request->input();
        $products =  Producto::where('nombre_producto', 'like', '%' .   $name  . '%')->orderBy($orden, $direccion)->paginate(5);


        $products->appends(["name" => $name, "ordenamiento" => $orden, "direccion_orden" => $direccion]);


        return view("administrador.productos.index", compact('products', "input"));
    }
}
