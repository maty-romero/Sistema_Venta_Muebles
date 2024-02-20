<?php

namespace App\Http\Controllers;

use App\Models\OfertaCombo;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Oferta;
use App\Models\OfertaMonto;
use App\Models\OfertaTipoMueble;
use App\Models\ProductoOferta;
use App\Models\TipoMueble;
use App\Rules\OfertaComboValida;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rules\OfertaUnitariaValida;
use App\Rules\OfertaMontoValida;
use App\Rules\OfertaTipoValida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OfertaController extends Controller
{

    public function index(Request $request)
    {
        /*$ofertas = Oferta::with("producto")
            ->orderBy("fecha_inicio_oferta", "asc")
            ->get();*/

        $ofertas = Oferta::query()->orderBy('fecha_inicio_oferta', 'asc')->get();
        
        if ($request->ajax()) {
            $tipoOferta = $request->input('tipoOferta');

            $campoOrden = $request->input('campoOrden');
            $direccionOrden = $request->input('direccionOrden');

            switch ($tipoOferta) {
                case 'ofertaCombo':
                    $ofertas = Oferta::query()->join('oferta_combo', 'ofertas.id', '=', 'oferta_combo.id_oferta_combo')
                    ->orderBy($campoOrden, $direccionOrden)
                    ->get();
                break;
                case 'producto':
                    $ofertas = Oferta::query()->join('oferta_producto', 'ofertas.id', '=', 'oferta_producto.id_oferta')
                    ->orderBy($campoOrden, $direccionOrden)
                    ->get();
                break;
                case 'ofertaMonto':
                    $ofertas = Oferta::query()->join('ofertas_montos', 'ofertas.id', '=', 'ofertas_montos.id_oferta_monto')
                    ->orderBy($campoOrden, $direccionOrden)
                    ->get();
                break;
                case 'ofertaMueble':
                    $ofertas = Oferta::query()->join('ofertas_tipos_muebles', 'ofertas.id', '=', 'ofertas_tipos_muebles.id_oferta_tipo')
                    ->orderBy($campoOrden, $direccionOrden)
                    ->get();
                break;
                case '':
                $ofertas = Oferta::query()
                    ->orderBy($campoOrden, $direccionOrden)
                    ->get();
                break;
            }

            $rol = Auth::user()->rol_usuario; // necesario para el renderizado dinamico
            
            foreach($ofertas as $of){
                $of->tipo = $of->getTipoOferta();
            }

            return response()->json(['ofertas' => $ofertas, "rol" => $rol]);
        }

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
            /*'tipoOferta' => [
                'required',
                'in:unitaria,combo,tipo,monto'
            ],*/
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

        $validado = false;
        switch(request()->input('tipoOferta')){
            case 'unitaria':
                $validado = Oferta::validarOfertaUnitaria();
                session()->flash('errorValid', 'Uno de los productos seleccionados y las fechas ingresadas generan conflicto con otra oferta similar');
                break;

            case 'combo':
                $validado = OfertaCombo::validarCombo();
                session()->flash('errorValid', 'Los productos y las fechas ingresadas generan conflicto con otro combo similar');
                break;

            case 'tipo':
                $validado = OfertaTipoMueble::validarOfertaTipo();
                session()->flash('errorValid', 'Las fechas ingresadas generan conflicto con otra oferta del mismo tipo.');
                break;

            case 'monto':
                $validado = OfertaMonto::validarOfertaMonto();
                session()->flash('errorValid', 'El monto y las fechas ingresadas generan conflicto con otra oferta similar');
                break;
        } 
        if(!$validado){
            return redirect()->back();
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
        $validado = false;
        if(ProductoOferta::where('id_oferta', $id)->first()){
            $prodId = ProductoOferta::where('id_oferta', $id)->first()->id_producto;

            $results = DB::select(
                "SELECT p.id, o.id 
                FROM `productos` AS p 
                INNER JOIN `oferta_producto` AS op ON p.id = op.id_producto
                INNER JOIN `ofertas` AS o ON o.id = op.id_oferta
                WHERE p.id = '$prodId' 
                AND o.id <> '$id'
                AND (p.deleted_at IS NULL and op.deleted_at IS NULL and o.deleted_at IS NULL)
                    AND (('$inicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                    OR ('$fin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                    OR (o.fecha_inicio_oferta BETWEEN '$inicio' AND '$fin')
                    OR (o.fecha_fin_oferta BETWEEN '$inicio' AND '$fin'))"
            );

            if (count($results) > 0) {
                $validado = false;
            } else {
                $validado = true;
            }
        } else if(OfertaCombo::find($id)){
            $combo = OfertaCombo::find($id);

            //Adecuar
            $comboSimilar = true;
            foreach ($combo->oferta_combo_producto as $prod) {
                $idProd = $prod->id_producto;
                $cant = $prod->cantidad_producto_combo;

                $results = DB::select(
                    "SELECT o.id, o.fecha_inicio_oferta, o.fecha_fin_oferta
                    FROM `ofertas` AS o
                    INNER JOIN `oferta_combo_producto` AS cp ON o.id = cp.id_oferta_combo
                    WHERE cp.id_producto = '$idProd' AND cp.cantidad_producto_combo = '$cant'
                    AND o.id <> '$id'
                    AND  (o.deleted_at IS NULL and cp.deleted_at IS NULL)
                    AND (('$inicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                    OR ('$fin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                    OR (o.fecha_inicio_oferta BETWEEN '$inicio' AND '$fin')
                    OR (o.fecha_fin_oferta BETWEEN '$inicio' AND '$fin'))"
                );
                if (count($results) <= 0) {
                    $comboSimilar = false;
                }
            }
            if ($comboSimilar) {
                $validado = false;
            }else{
                $validado = true;
            }
        } else if(OfertaMonto::find($id)){
            $monto = OfertaMonto::find($id)->monto_limite_descuento;

            $results = DB::select(
            "SELECT o.id
            FROM `ofertas_montos` AS om
            INNER JOIN `ofertas` AS o ON o.id = om.id_oferta_monto
            WHERE om.monto_limite_descuento = '$monto'
            AND o.id <> '$id'
            AND (o.deleted_at IS NULL and om.deleted_at IS NULL)
                AND (('$inicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                OR ('$fin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                OR (o.fecha_inicio_oferta BETWEEN '$inicio' AND '$fin')
                OR (o.fecha_fin_oferta BETWEEN '$inicio' AND '$fin'))"
                );
            if (count($results) > 0) {
                $validado = false;
            } else {
                $validado = true;
            }
        }else if(OfertaTipoMueble::find($id)){
            $idTipo = OfertaTipoMueble::find($id)->id_tipo_mueble; 

            $results = DB::select(
            "SELECT o.id, o.fecha_inicio_oferta, o.fecha_fin_oferta, ot.id_tipo_mueble
            FROM `ofertas_tipos_muebles` AS ot
            INNER JOIN `ofertas` AS o ON o.id = ot.id_oferta_tipo
            WHERE ot.id_tipo_mueble = '$idTipo'
            AND o.id <> '$id'
            AND (ot.deleted_at IS NULL and o.deleted_at IS NULL)
                AND (('$inicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                OR ('$fin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                OR (o.fecha_inicio_oferta BETWEEN '$inicio' AND '$fin')
                OR (o.fecha_fin_oferta BETWEEN '$inicio' AND '$fin'))"
            );
    
            if (count($results) > 0) {
                $validado = false;
            } else {
                $validado = true;
            }
        }

        // SI HAY COINCIDENCIAS NOTIFICO
        if (!$validado) {
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
            //$oferta->save();
            session()->flash('success_oferta', 'La oferta ha sido modificado exitosamente');
        } else {
            session()->flash('error_oferta', 'Ha ocurrido un error al editar el oferta');
        }
        return redirect()->back();
    }

    public function destroy(string $oferta)
    {
        ProductoOferta::where('id_oferta', $oferta)->delete();
        OfertaCombo::where('id_oferta_combo', $oferta)->delete();
        OfertaTipoMueble::where('id_tipo_mueble', $oferta)->delete();
        Oferta::find($oferta)->delete();
        //session()->flash('success_oferta', 'La ferta ha sido eliminada exitosamente');
        return redirect()->back();
    }

    public function searchComboById(string $id)
    {
        $today = date("Y-m-d");
        $combo = Oferta::where("id", $id)->where('fecha_inicio_oferta', "<=", $today)->where('fecha_fin_oferta', ">=", $today)->get();
        $combo = $combo[0];
        //->whereHas("ofertaCombo")


        $arrayProductosCombos = [];

        $arrayCHECKTEMP = [];

        $idProductos = DB::select("select id_producto from oferta_combo_producto where id_oferta_combo = '$combo->id' and deleted_at IS NULL)");

        // ID´S PRODUCTOS DEL COMBO (CON COMPROBACION STOCK/DISCONTINUO)
        $idProductosCheck = DB::select("    
        SELECT id,cantidad_producto_combo FROM productos LEFT JOIN oferta_combo_producto ON productos.id = oferta_combo_producto.id_producto
        WHERE (discontinuado=0 AND stock>=oferta_combo_producto.cantidad_producto_combo) AND (id_oferta_combo = '$combo->id') AND (productos.deleted_at IS NULL AND oferta_combo_producto.deleted_at IS NULL)
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
