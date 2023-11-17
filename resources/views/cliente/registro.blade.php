<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registrar cliente</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased bg-[#FFE794] bg-pattern-image ">
    <x-custom.navbar_client></x-custom.navbar_client>

    <div class="flex items-center justify-center pt-16">
        <div class="bg-white p-8 rounded-2xl shadow-md max-w-3xl w-full ">

            @if(session('success'))
            <div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <h2 class="font-figtree text-3xl mb-6 text-center font-bold">Muebles Patagonia</h2>

            <form action="{{ route('cliente_store') }}" method="POST" class="grid grid-cols-2 gap-4">
                @csrf

                <input type="hidden" id="idHiddenRolUsuario" name="cmbRolUsuario" value="cliente">

                <!-- Columna 1 -->
                <div>
                    <p class="font-poppins text-1g">Nombre de usuario</p>
                    <input id="txtNombreUsuario" name="nombreUsuario" type="text" value="{{ old('nombreUsuario') }}" class="rounded-md mb-4  flex w-full">
                    @error('nombreUsuario')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">Email</p>
                    <input id="txtEmail" name="email" type="email" value="{{ old('email') }}" class="rounded-md mb-4  flex w-full">
                    @error('email')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">Contraseña</p>
                    <input id="txtContrasenia1" name="password" type="password" class="rounded-md mb-4  flex w-full">
                    @error('password')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">Confirmar contraseña</p>
                    <input id="txtContrasenia2" name="password_confirmation" type="password" class="rounded-md mb-4  flex w-full">
                    @error('password_confirmation')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">Nombre cliente</p>
                    <input id="txtNombreCliente" name="nombreCliente" value="{{ old('nombreCliente') }}" type="text" class="rounded-md mb-4  flex w-full">
                    @error('nombreCliente')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Columna 2 -->
                <div>
                    <p class="font-poppins text-1g">Tipo de cliente</p>
                    <select id="idCmbTipoCliente" name="cmbTipoCliente" class="font-poppins text-1g rounded-md mb-4  flex w-full">
                        <option value="fisico">Fisico</option>
                        <option value="juridico" selected>Juridico</option>
                    </select>
                    @error('cmbTipoCliente')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">DNI / CUIT</p>
                    <input id="txtDniCuit" name="dni_cuit" value="{{ old('dni_cuit') }}" type="number" class="rounded-md mb-4  flex w-full">
                    @error('dni_cuit')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">Código Postal</p>
                    <input id="txtCodigoPostal" name="codigoPostal" value="{{ old('codigoPostal') }}" type="number" class="rounded-md mb-4  flex w-full">
                    @error('codigoPostal')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <p class="font-poppins text-1g">Número de Teléfono</p>
                    <input id="txtTelefono" name="telefono" value="{{ old('telefono') }}" type="number" class="rounded-md mb-4  flex w-full">
                    @error('telefono')
                    <br>
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                    <br>

                </div>
                <div></div>
                <div class="ml-auto"> <button type="submit" class="mt-6 bg-gray-800 text-white py-2 px-6 rounded-md text-base">
                        Registrarse
                    </button></div>
            </form>
        </div>
    </div>

</body>

</html>