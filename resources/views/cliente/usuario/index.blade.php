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

    <title>Perfil Cliente</title>

</head>
<body class="antialiased bg-[#FFE794] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)] bg-pattern-image">
    <x-custom.navbar_client>
    </x-custom.navbar_client>
    <br><br>
    <div id="infoCliente" class="container mx-auto bg-white rounded-2xl p-6">
        <h3 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Usuario</h3>
        <form action="">

            <div class="py-5">
                <table>
                    <tr>
                        <td class="pr-16"><label class="font-poppins">Nombre</label></td>
                        <td class="pr-16"><label class="font-poppins">Personer&iacute;a</label></td>
                        <td class="pr-16"><label class="font-poppins">Documento</label></td>
                    </tr>
                    <tr>
                        <td class="pr-16"><input id="txtNombre" type="text" class="rounded-md"></td>
                        <td class="pr-16"><input id="txtPersoneria" type="text" disabled class="rounded-md"></td>
                        <td class="pr-16"><input id="txtDocumento" type="text" class="rounded-md"></td>
                    </tr>
                    <tr>
                        <td class="pr-16 pt-8"><label class="font-poppins">Email</label></td>
                        <td class="pr-16 pt-8"><label class="font-poppins">C&oacute;digo Postal</label></td>
                        <td class="pr-16 pt-8"><label class="font-poppins">N&uacute;mero de T&eacute;lefono</label></td>
                    </tr>
                    <tr>
                        <td class="pr-16"><input id="txtEmail" type="text" class="rounded-md"></td>
                        <td class="pr-16"><input id="txtCodigoPostal" type="text" class="rounded-md"></td>
                        <td class="pr-16"><input id="txtNroTel" type="text" class="rounded-md"></td>
                    </tr>
                </table>
            </div>
            
            <div class="relative flex flex-row">
                <button class="flex select-none items-center gap-2 rounded-lg py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase bg-gray-500 text-white hover:bg-gray-500 transition-all active:bg-gray-600 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Editar Contraseña
                </button>
            </div>
            <br>
            <div class="relative flex flex-row">
                <button id="btnConfirmarCambios" class="ml-auto py-3 px-6 rounded-lg text-center font-sans text-sm font-bold uppercase bg-green-500 text-white hover:bg-green-600 transition-all" type="button">
                    Confirmar cambios
                </button>
            </div>
            
        </form>
    </div>
    
    <div id="comprasRecientes" class="container mx-auto mt-10 bg-white rounded-2xl p-6">
        <h2 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Compras recientes</h2><br>
        
        <x-custom.sale-item>
        </x-custom.sale-item>
              
        
         
    </div>    
</body>
</html>