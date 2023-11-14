<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper;


class ReporteController extends Controller
{
    public function ReporteRedirect(Request $request)
    {

        if ("VC" === $request->tipoReporte) {

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
        } else if ("PMV" === $request->tipoReporte) {

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
        }

        $jasper = new PHPJasper();

        $jasper->compile($input)->execute();

        $jasper->process($input, $output, $options)->execute();

        return response()->file($pathToFile);
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
