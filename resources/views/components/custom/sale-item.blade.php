<div class="flex flex-row rounded-xl bg-white border border-red-500 p-4 text-gray-700 shadow-md mb-5">
    
    <div class="w-1/2 p-4 flex items-center space-x-8">
        <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased mb-2">
            #{{ $nroPago }} &emsp; Domicilio de env&iacute;o: <span class="font-sans text-1g font-normal leading-relaxed text-gray-700 antialiased">{{ $domicilioEnvio }}</span>
        </h4>
    </div>

    <div class="w-1/2 p-4 flex items-center space-x-8">
        <div>
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased mb-2">
                Fecha: <span class="font-sans text-1g font-normal leading-relaxed text-gray-700 antialiased">{{ $fechaVenta }}</span>
            </h4>
        </div>
        <div>
            <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased mb-2">
                Total: <span class="font-sans text-1g font-normal leading-relaxed text-gray-700 antialiased">@money($totalVenta)</span>
            </h4>
        </div>
    </div>

    <div class="w-1/6 flex justify-end items-center p-6">
        <a class="inline-block" href="{{ route('cliente_comprobante_compra', ['nroComprobante' => $ventaId]) }}" target="_blank">
            <button class="flex select-none items-center gap-2 rounded-lg py-2 px-7 text-center align-middle font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all active:bg-green-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                Ver detalle
            </button>
        </a>
    </div>
</div>
