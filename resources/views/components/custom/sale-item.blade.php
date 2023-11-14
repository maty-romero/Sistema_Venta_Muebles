<!-- stylesheet -->
<link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"/>

<div class="flex flex-row rounded-xl bg-white border border-red-500 p-4 text-gray-700 shadow-md mb-5">
    <div class="w-1/5 relative shrink-0 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700">
        <img
            src="{{ $imagenURL }}"
            alt="image"
            class="h-100 w-100 object-cover"
        />
    </div>
    <div class="w-1/2 p-4">

        <div class="mb-2">
            <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                #{{ $nroPago }}
            </h4>
            <p class="mb-2 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased">

            </p>
        </div>
        <div class="mb-2">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Domicilio de env&iacute;o
            </h4>
            <p class="mb-2 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased">
                {{ $domicilioEnvio }}
            </p>
        </div>
            
    </div>
    <div class="w-1/5 p-4">
        <div class="mb-2">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Fecha
            </h4>
            <p class="mb-2 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased">
                {{ $fechaVenta }}
            </p>
        </div>
        <div class="mb-2">
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Total
            </h4>
            <p class="mb-2 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased">
                ${{ $totalVenta }}
            </p>
        </div>
    </div>
    <div class="w-2/6 flex justify-end items-center p-6">
        <a class="inline-block" href="{{ route('cliente_show_venta', ['idVenta' => $ventaId]) }}">
            <button
                class="flex select-none items-center gap-2 rounded-lg py-2 px-7 text-center align-middle font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                Ver detalles
            </button>
        </a>
    </div>
</div>





  
