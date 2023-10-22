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
<body class="antialiased bg-[#FFE794] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)] bg-pattern-image ">
    <div id="infoCliente" class="container mx-auto bg-white rounded-2xl p-6">
        <h3>Usuario</h3>
        <form action="">
            <div class="grid place-items-center">
            <table>
                <tr>
                    <td><label>Nombre</label></td>
                    <td><label>Personer&iacute;a</label></td>
                    <td><label>Documento</label></td>         
                </tr>
                <tr >
                    <td ><input id="txtNombre" type="text" ></td>
                    <td><input id="txtPersoneria" type="text" disabled></td>
                    <td><input id="txtDocumento" type="text"></td>
                </tr>
                <tr>
                    <td class="pt-8"><label>Email</label></td>
                    <td class="pt-8"><label>C&oacute;digo Postal</label></td>
                    <td class="pt-8"><label>N&uacute;mero de T&eacute;lefono</label></td>         
                </tr>
                <tr>
                    <td><input id="txtEmail" type="text"></td>
                    <td><input id="txtCodigoPostal" type="text"></td>
                    <td><input id="txtNroTel" type="text"></td>
                </tr>
            </table>
            </div>
            <button id="btnCambioContrasenia" type="button">Editar Contraseña</button>
        </form>
        <button id="btnConfirmarCambios" type="button">Confirmar cambios</button>
    </div>
    <br><br>
    <div id="comprasRecientes" class="container mx-auto mt-10 bg-white rounded-2xl p-6">
        <h2 class="">Compras recientes</h2><br>
        <div>
            <x-custom.sale-item>
            </x-custom.sale-item>
              
        </div>
         
    </div>    
</body>
</html>