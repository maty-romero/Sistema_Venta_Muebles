<!-- component -->
<nav class="bg-white shadow px-32">
    <div class="container mx-auto px-6 py-3 md:flex md:justify-between md:items-center">
        <div class="flex justify-between items-center">
            <x-custom.input-search></x-input-search>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div class="md:flex items-center">

            <div class="grid grid-cols-2 divide-x ">
                <div class="flex justify-center items-center ml-auto pr-4">
                    <a class="relative text-gray-500 font-bold" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <!-- <span class="absolute top-0 left-0 rounded-full bg-indigo-500 text-white p-1 text-xs"></span> -->
                    </a>
                </div>
                <div class="pl-4 text-gray-500">
                    @if (Route::has('login'))
                    @auth
        
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
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