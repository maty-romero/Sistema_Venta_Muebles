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

    <title>Crear Usuario</title>

</head>
<body class="antialiased bg-[#F0F0F0] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)] bg-pattern-image">
    <x-custom.navbar>
    </x-custom.navbar>
    <div id="detalleVenta" class="container mx-auto p-6">
        <h1 class="mb-2 block font-sans text-5xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Crear Usuario</h1><br>
        
        <!-- 
        Nombre Usuario
        Email 
        Rol Usuario
        -->
        <form action="">
            <p class="font-poppins text-1g">Nombre Usuario</p>
            <input id="txtNombreUsuario" type="text" class="rounded-md mb-10">

            <p class="font-poppins text-1g">Email</p>
            <input id="txtEmail" type="email" class="rounded-md mb-10">

            <p class="font-poppins text-1g">Rol de Usuario</p>

            <select name="cmbRolUsuario" class="font-poppins text-1g">
                <option value="cliente">Cliente</option>
                <option value="jefe_ventas" selected>Jefe de Ventas</option>
                <option value="gerente">Gerente</option>
            </select>
        
            <br>
            <button class="mt-7 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
                Confirmar
            </button>
        </form>
        
        
    </div>
    
    
    
    
    
    
    
    
              
        
         
       
</body>
</html>