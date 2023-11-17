<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use PHPJasper\PHPJasper;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ReporteController extends Controller
{


    public function index(?string $id = null)
    {


        $usuarios = User::with("cliente")->get();

        return view("administrador.reportes.index", compact("usuarios", "id"));
    }


    public function ReporteRedirect(Request $request)
    {


        $checkResultados = "";
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');



        // if ($request->input("idCliente")) {
        //     $checkCliente = Cliente::find($request->input("idCliente"));

        //     if ($checkCliente !== null) {
        //         $checkResultados = DB::select("SELECT monto_final_venta,nro_pago,codigo_postal_destino,domicilio_destino,fecha_venta
        //         FROM clientes
        //         LEFT JOIN ventas ON clientes.id_usuario_cliente = ventas.id_usuario_cliente
        //         WHERE (ventas.fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin')
        //          AND clientes.id_usuario_cliente=$checkCliente->id_usuario_cliente");
        //     }
        // } else {
        //     $checkResultados = DB::select("SELECT id_producto,productos.nombre_producto,productos.precio_producto as precio_unitario,SUM(unidades_vendidas_prod)
        //     FROM producto_venta 
        //     LEFT JOIN productos ON producto_venta.id_producto= productos.id
        //     LEFT JOIN ventas ON producto_venta.id_venta= ventas.id
        //     WHERE ventas.fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin'
        //     GROUP BY producto_venta.id_producto
        //     ORDER BY SUM(unidades_vendidas_prod) DESC");
        // }


        // if ($checkResultados !== null) {

        if ("VC" === $request->input('tipoReporte')) {


            $input = base_path() . '\database\reportes\Ventas_Cliente.jrxml';
            $output = base_path() . '\database\reportes\output\VentasCliente';

            $options = [
                'format' => ['pdf'],
                'locale' => 'en',
                'params' => [
                    'Fecha_inicio' => strval($request->fechaInicio),
                    'Fecha_fin' => strval($request->fechaFin),
                    "Cliente" => strval($request->idCliente)
                ],
                'db_connection' => [
                    //datos conexión base
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'database' => 'muebleApp',
                    'username' => 'root',

                ],
            ];

            $pathToFile = base_path() . '\database\reportes\output\VentasCliente.pdf';
        } else if ("PMV" === $request->input('tipoReporte')) {

            $input = base_path() . '\database\reportes\Productos_Mas_Vendidos.jrxml';
            $output = base_path() . '\database\reportes\output\ProductosMasVendidos';



            $options = [
                'format' => ['pdf'],
                'locale' => 'en',
                'params' => [
                    'Fecha_inicio' => strval($request->fechaInicio),
                    'Fecha_fin' => strval($request->fechaFin),
                ],
                'db_connection' => [
                    //datos conexión base
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'database' => 'muebleApp',
                    'username' => 'root',

                ],
            ];

            $pathToFile = base_path() . '\database\reportes\output\ProductosMasVendidos.pdf';
        } else {

            $input = base_path() . '\database\reportes\Ofertas_Mas_Vendidas.jrxml';
            $output = base_path() . '\database\reportes\output\OfertasMasVendidas';



            $options = [
                'format' => ['pdf'],
                'locale' => 'en',
                'params' => [
                    'Fecha_inicio' => strval($request->fechaInicio),
                    'Fecha_fin' => strval($request->fechaFin),
                ],
                'db_connection' => [
                    //datos conexión base
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'database' => 'muebleApp',
                    'username' => 'root',

                ],
            ];

            $pathToFile = base_path() . '\database\reportes\output\OfertasMasVendidas.pdf';
        }



        $jasper = new PHPJasper();

        $jasper->compile($input)->execute();

        $jasper->process($input, $output, $options)->execute();

        return response()->file($pathToFile);
        // } else {
        //     return response(["error" => "No hay resultados para generar el reporte seleccionado."]);
        // }
    }


    public function ReporteProductosMasVendidos(Request $request)
    {

        $input = base_path() . '\database\reportes\Productos_Mas_Vendidos.jrxml';
        $output = base_path() . '\database\reportes\output\ProductosMasVendidos';



        $options = [
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [
                'Fecha_inicio' => strval($request->fechaInicio),
                'Fecha_fin' => strval($request->fechaFin),
            ],
            'db_connection' => [
                //datos conexión base
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'database' => 'muebleApp',
                'username' => 'root',

            ],
        ];

        $jasper = new PHPJasper();

        $jasper->compile($input)->execute();

        $jasper->process($input, $output, $options)->execute();

        $pathToFile = base_path() . '\database\reportes\output\ProductosMasVendidos.pdf';

        return response()->file($pathToFile);
    }

    public function ReporteVentasCliente(Request $request)
    {

        $input = base_path() . '\database\reportes\Ventas_Cliente.jrxml';
        $output = base_path() . '\database\reportes\output\VentasCliente';

        $options = [
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [
                'Fecha_inicio' => strval($request->fechaInicio),
                'Fecha_fin' => strval($request->fechaFin),
                "Cliente" => strval($request->idCliente)
            ],
            'db_connection' => [
                //datos conexión base
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'database' => 'muebleApp',
                'username' => 'root',

            ],
        ];

        $jasper = new PHPJasper();

        $jasper->compile($input)->execute();

        // $x = $jasper->process(
        //     $input,
        //     $output,
        //     $options
        // )->output();
        // print_r($x);
        // exit(1); //just to avoid getting error handler on your framework

        $jasper->process($input, $output, $options)->execute();



        $pathToFile = base_path() . '\database\reportes\output\VentasCliente.pdf';

        return response()->file($pathToFile);
    }


    public function ReporteRestante(Request $request)
    {

        $input = base_path() . '\database\reportes\Productos_Mas_Vendidos.jrxml';
        $output = base_path() . '\database\reportes\output\ProductosMasVendidos';



        $options = [
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [
                'Fecha_inicio' => strval($request->fechaInicio),
                'Fecha_fin' => strval($request->fechaFin),
                "Cliente" => $request->idCliente
            ],
            'db_connection' => [
                //datos conexión base
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'database' => 'muebleApp',
                'username' => 'root',

            ],
        ];

        $jasper = new PHPJasper();

        $jasper->compile($input)->execute();

        $jasper->process($input, $output, $options)->execute();

        $pathToFile = base_path() . '\database\reportes\output\ProductosMasVendidos.pdf';

        return response()->file($pathToFile);
    }
}
