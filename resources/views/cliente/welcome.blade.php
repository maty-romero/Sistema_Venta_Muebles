<x-app-layout>
    <x-custom.navbar>
    </x-custom.navbar>
    <div class="grid grid-cols-4 px-32 gap-x-4">
        @foreach ( $productos as $producto )
        <x-custom.card :producto="$producto">
        </x-custom.card>
        @endforeach
    </div>
</x-app-layout>