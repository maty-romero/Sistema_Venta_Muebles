<?php

namespace App\Http\Controllers;

use App\Models\OfertaCombo;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Oferta;
use App\Models\TipoMueble;
use App\Rules\OfertaComboValida;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rules\OfertaUnitariaValida;
use App\Rules\OfertaMontoValida;
use App\Rules\OfertaTipoValida;

use Illuminate\Support\Facades\Storage;

class OfertaController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tipoOferta = $request->input('tipoOferta');
            $campoOrden = $request->input('campoOrden');
            $direccionOrden = $request->input('direccionOrden');

            $ofertas = Oferta::with($tipoOferta)
                ->orderBy($campoOrden, $direccionOrden)
                ->get();

            return response()->json(['ofertas' => $ofertas]);
        }

        $ofertas = Oferta::with("producto")
            ->orderBy("fecha_inicio_oferta", "asc")
            ->get();

        // Sino hay solicitud AJAX  
        return view('administrador.ofertas.index', compact("ofertas"));
    }

    public function create()
    {
        $productos = Producto::getProductosDisponibles();
        $tiposProducto = TipoMueble::all();
        return view('administrador.ofertas.create', ['productos' => $productos, 'tiposProducto' => $tiposProducto]);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'tipoOferta' => [
                'required',
                'in:unitaria,combo,tipo,monto'
            ],
            'fechaInicio' => [
                'required',
                'after:' . date("m/d/" . (date("Y") - 1)),
                'before:' . request()->input('fechaFin')
            ],
            'fechaFin' => [
                'required',
                'after:' . date("m/d/Y"),
                'after:' . request()->input('fechaInicio')
            ],
            'descuento' => [
                'required',
                'numeric',
                'max:95',
                'min:5'
            ],
            'nombreCombo' => [
                'required_if:tipoOferta,combo',
                'max:30',
                'nullable',
                'min:3'
            ],
            'imagenCombo' => [
                'required_if:tipoOferta,combo',
                'nullable',
                'image'
            ],
            'tipoMueble' => [
                'required_if:tipoOferta,tipo',
                'nullable',
                'in:1,2',
                new OfertaTipoValida
            ],
            'montoMin' => [
                'required_if:tipoOferta,monto',
                'nullable',
                'numeric',
                'min:1000',
                new OfertaMontoValida
            ],
            'productos' => [
                'required_if:tipoOferta,unitaria',
                new OfertaUnitariaValida,
                'required_if:tipoOferta,combo',
                new OfertaComboValida,
                'nullable',
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Oferta::crearOferta();
        return to_route('administrador_ofertas');
    }

    public function show(string $id)
    {
        $combo = OfertaCombo::findOrFail($id);
        if ($combo->comboActivo()) {
            $enCarrito = Venta::enCarrito('Combo', $id);
            return view('cliente/combo/show', ['combo' => $combo, 'enCarrito' => $enCarrito]);
        }
        return to_route('home');
    }

    public function edit(Oferta $oferta)
    {
        return view('administrador.ofertas.edit', ['oferta' => $oferta]);
    }
    // 

    public function update(Request $request, $id)
    {

        $inicio = $request->input("fecha_inicio_oferta");
        $fin = $request->input("fecha_fin_oferta");


        if ($inicio >= $fin) {
            session()->flash('error_oferta', 'Debe haber al menos un periodo de un dia entre fecha de inicio y fin.');
            return redirect()->back();
        }

        $oferta = Oferta::find($id);
        $queryProducto = "";
        foreach ($oferta->producto as $producto) {   // TODOS LOS PRODUCTOS QUE POSEEN LA OFERTA A EDITAR
            $queryProducto .= "id_producto={$producto->id} OR ";
        }
        $queryProducto = substr($queryProducto, 0, -4);

        // SELECCIONO TODAS LAS OFERTAS QUE TENGAN LOS PRODUCTOS ALCANZADOS POR LA OFERTA Y SE ENCUENTREN CON FECHA SUPERPUESTA

        $controlSuperposicion = DB::select("SELECT * FROM ofertas LEFT JOIN oferta_producto ON oferta_producto.id_oferta=ofertas.id  
        WHERE ((ofertas.fecha_inicio_oferta  BETWEEN '$inicio' AND '$fin') 
        OR (ofertas.fecha_fin_oferta BETWEEN '$inicio' AND '$fin')) 
        AND ($queryProducto) AND ofertas.id != $producto->id");


        // SI HAY COINCIDENCIAS NOTIFICO

        if (count($controlSuperposicion) > 0) {
            session()->flash('error_oferta', 'Existe un conflicto de fechas');
            return redirect()->back();
        }



        $validated = $request->validate([
            'fecha_inicio_oferta' => 'required',
            'fecha_fin_oferta' => 'required',
            'porcentaje_descuento' => 'required|between:1,99',
        ]);


        if ($validated) {

            $oferta->update([
                'fecha_inicio_oferta' => $request->input('fecha_inicio_oferta'),
                'fecha_fin_oferta' => $request->input('fecha_fin_oferta'),
                'porcentaje_descuento' => $request->input('porcentaje_descuento'),
            ]);

            $oferta->save();
            session()->flash('success_oferta', 'El oferta ha sido modificado exitosamente');
        } else {
            session()->flash('error_oferta', 'Ha ocurrido un error al editar el oferta');
        }
        return redirect()->back();
    }

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
