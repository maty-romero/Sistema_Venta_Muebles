<!-- component -->
<nav class="bg-white shadow px-full shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
    <div class="container mx-auto px-6 py-3 md:flex md:justify-between md:items-center">
        <div class="flex justify-between items-center">
            <!-- Eliminamos el componente de búsqueda aquí -->
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div class="md:flex items-center">
            <div class="grid grid-cols-2 divide-x">
                <div class="pl-4 text-gray-500">
                    @if (Route::has('login'))
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="hover:text-gray-600 pr-4"> Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-600">Registrarse</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
