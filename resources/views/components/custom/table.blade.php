<!-- component -->

<body class="antialiased font-sans bg-gray-200">
    <div class="container mx-auto">
        <div class="py-8">
            <div class="inline-block min-w-full shadow overflow-hidden">
                <table class="min-w-full leading-normal items-center border-gray-600 border-2 justify-center">
                    <thead>
                        <tr>
                            @foreach ($columnas as $columna)
                                <th class="px-5 py-3 border-b-2 border-gray-500 bg-gray-400 text-left text-lg font-semibold text-white">
                                    {{ $columna }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

