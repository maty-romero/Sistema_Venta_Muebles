<?php

namespace App\Http\Controllers;

use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoVendido;
use App\Models\User;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function indexProductos()
    //{
    //   $productos = Producto::get();
    //   return (view("administrador.productos.index", compact("productos")));
    //}
    

    public function index(){
    
        //$users = User::where('name', 'John')->orWhere('name', 'Jane')->get();
        $productos = Producto::orderBy('nombre_producto', 'asc')->paginate(5);;
        // $productos = Producto::paginate(5);
        // dd($productos);

         return view("administrador.productos.index", compact("productos"));
        //$productos = Producto::all();
        
       //return (view("cliente.welcome", compact("productos")));

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

        // $productoVenta = ProductoVendido::where("id_venta", 2)->where("id_producto", 9)-first();
        // echo $productoVenta->oferta;
        // $oferta = Oferta::find(1);
        // echo $oferta->ofertaProductoVendido;

        // $ofertaMueble = OfertaTipoMueble::find(7);
        // echo $ofertaMueble->tipoMueble;

        // $cliente = Cliente::find(1);
        // echo $cliente->usuario;


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
    public function store(Request $request)
    {
        // dd($request->input('nombreProducto'));
        // dd($request->input('cmbTipoMueble'));
        
              $producto = Producto::create(['nombre_producto' => $request->input('nombreProducto'),
        'descripcion' => $request->input('descripcion'),
        'stock' => $request->input('stockInical'),
        'precio_producto' => $request->input('precio'),
        'id_tipo_mueble' => $request->input('cmbTipoMueble'),
        'largo' => $request->input('largo'),
        'ancho' => $request->input('ancho'),
        'alto' => $request->input('alto'),
        'material' => $request->input('cmbMaterialMueble')
        , ]);

        $producto->save();
        
        return redirect()->route('producto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('cliente/productos/show', ['producto' => $producto]);
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
    public function update(Request $request, Producto $producto)
    {

        $producto->update(['nombre_producto' => $request->input('nombreProducto'),
        'descripcion' => $request->input('descripcion'),
        'precio_producto' => $request->input('precio'),
        'id_tipo_mueble' => $request->input('cmbTipoMueble'),
        'largo' => $request->input('largo'),
        'ancho' => $request->input('ancho'),
        'alto' => $request->input('alto'),
        'material' => $request->input('cmbMaterialMueble')
        , ]);
        return redirect()->route('producto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('producto.index');
    }

    public function searchProduct(Request $request)
    {
        $productos = Producto::where("nombre_producto", $request->input('name'))->orWhere('nombre_producto', 'like', '%' .  $request->input('name') . '%')->paginate(2);

        $productos->appends(["name" => $request->input('name')]);

        return (view("cliente.productos.index", compact("productos")));
    }

    public function updateStock(Request $request, Producto $producto)
    {

        $producto->update(['stock' => $request->input('stockActualizado'),]);
        return 'Stock nuevo';//redirect()->route('producto.index');
    }
}
