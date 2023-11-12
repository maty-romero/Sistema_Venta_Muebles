{{-- Pefil del usuario --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Detalle Compra</title>

</head>
<body class="antialiased bg-[#FFE794] bg-pattern-image">
    <x-custom.navbar_client>
    </x-custom.navbar_client>
    <div id="detalleVenta" class="container mx-auto p-6">
        <h1 class="mb-2 block font-sans text-5xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Detalle Compra</h1><br>
        
        @php
            dump($datos); 
            $totalVenta = 0; 
        @endphp
        
        <div class="w-full">

            <x-custom.table :columnas="['Nombre Producto', 'Cantidad', 'Precio Unitario', 'Descuento', 'Total']">
                @if (count($datos['productos']) > 0)
                    @foreach ($datos['productos'] as $producto)
                        <tr>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">{{ $producto['nombre_producto'] }}</td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">{{ $producto['unidades_vendidas'] }}</td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">@money($producto['precio_producto'])</td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                @if ($producto['porcentaje_descuento'] != null)
                                    @money(($producto['porcentaje_descuento'] * $producto['precio_producto']) / 100) (%{{ $producto['porcentaje_descuento'] }})
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">@money($producto['precio_producto']*$producto['unidades_vendidas'])</td>
                            @php
                                $totalVenta += $producto['precio_producto']*$producto['unidades_vendidas']; 
                            @endphp
                        </tr>
                    @endforeach
                @endif
               
                @if (count($datos['combos']) > 0)
                    @foreach ($datos['combos'] as $combo)
                        <tr>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">{{ $combo['nombre_combo'] }}</td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">{{ $combo['unidades_vendidas'] }}</td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">@money($combo['precio_unitario'])</td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                @if ($combo['porcentaje_descuento'] != null)
                                @money(($combo['porcentaje_descuento'] * $combo['precio_unitario']) / 100) (%{{ $combo['porcentaje_descuento'] }})
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">@money($combo['precio_unitario']*$combo['unidades_vendidas'])</td>
                        
                            @php
                                $totalVenta += $combo['precio_unitario']*$combo['unidades_vendidas']; 
                            @endphp
                        </tr>
                    @endforeach
                @endif

            </x-custom.table>

            <div class="bg-gray-600 container mx-auto rounded-lg p-6">
                <div class="flex justify-between">
                    <p class="text-white font-poppins text-2xl">Total</p>
                    <p class="text-white font-poppins text-2xl"> @money($totalVenta)</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-white font-poppins text-2xl">Fecha Facturaci&oacute;n</p>
                    <p class="text-white font-poppins text-2xl">{{ $datos['venta']['fecha_venta'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-white font-poppins text-2xl">Domicilio Facturaci&oacuten</p>
                    <p class="text-white font-poppins text-2xl">{{ $datos['venta']['domicilio_destino'] }}</p>
                </div>
            </div>

        </div>

        <div class="flex justify-end">
            <button class="bg-gray-800 text-white py-2 px-4 rounded-md text-base mt-4">
                Ver Comprobante
            </button>
        </div>
    </div>
    
    
 
       
</body>
</html>