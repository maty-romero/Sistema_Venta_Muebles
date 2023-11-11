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
    public function index()
    {
        $productos = Producto::all();
        return (view("cliente.welcome", compact("productos")));
    }

    public function index_adm(){
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
