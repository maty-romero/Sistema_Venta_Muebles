<!-- component -->
<nav class="bg-white shadow px-32 mb-4 ">
    <div class="container min-w-full py-3 flex justify-between items-center">
        @if (isset($name))
        <div class="flex justify-between items-center">
            <div class="flex justify-center items-center ml-auto pr-4">
                <a class="relative text-gray-500 font-bold" href="{{route('home')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9" />
                        <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6" />
                    </svg>
                </a>
            </div>
            <x-custom.input-search :name="$name">
                </x-input-search>
        </div>
        @else
        <div class="flex justify-between items-center">
            <div class="flex justify-center items-center ml-auto pr-4">
                <a class="relative text-gray-500 font-bold" href="{{route('home')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9" />
                        <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6" />
                    </svg>
                </a>
            </div>
            <x-custom.input-search>
                </x-input-search>
        </div>
        @endif
        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div class="md:flex items-center">
            <div class="grid grid-cols-2 divide-x ">
                @if(Auth::user())
                <div class="grid grid-cols-2 divide-x ">
                    <div class="flex justify-center items-center ml-auto px-4">
                        <a class="relative text-gray-500 font-bold" href="{{route('carrito')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <!-- <span class="absolute top-0 left-0 rounded-full bg-indigo-500 text-white p-1 text-xs"></span> -->
                        </a>
                    </div>
                    <div class="flex justify-center items-center px-0 ml-0 mr-0">
                        <a class="relative text-gray-500 font-bold" href="{{route('cliente_show')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                                <circle cx="12" cy="10" r="3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </a>
                    </div>
                </div>
                @else
                <div class="flex justify-center items-center ml-auto px-4">
                    <a class="relative text-gray-500 font-bold" href="{{route('carrito')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <!-- <span class="absolute top-0 left-0 rounded-full bg-indigo-500 text-white p-1 text-xs"></span> -->
                    </a>
                </div>
                @endif
                <div class="pl-1 text-gray-500">
                    @if(Route::has('login'))
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                    @else

                    @component('components.custom.modal_login')
                    @slot('textoBtn', 'Iniciar sesión')
                    @slot('clasesBtn', "leading-5 px-1 py-2 text-gray-500 hover:text-gray-100 hover:bg-gray-800 focus:bg-gray-800 focus:outline-none pr-1 transition duration-150 ease-in-out")

                    @slot('encabezado', 'Iniciar sesión')
                    @slot('contenido')
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label class='block font-medium text-sm text-zinc-700'>Email</label>
                            <input id='email' name='email' value="{{old('email')}}" required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                            @error('email')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class='block font-medium text-sm text-zinc-700'>Contrase&ntilde;a</label>
                            <input id='password' name='password' type='password' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                            @error('password')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-400 text-zinc-700 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                            </label>
                            <button type='submit' class='inline-flex ml-auto items-center px-6 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Iniciar sesi&oacute;n</button>
                        </div>
                        <div class='flex pt-4 mt-4 border-t border-t-zinc-200'>
                            @if (Route::has('password.request'))
                            <a class="underline mr-2 text-sm text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                Olvidaste tu contrase&ntilde;a?
                            </a>
                            @endif
                            <p class='text-right ml-auto text-sm text-zinc-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'>
                                <a class="underline text-sm text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('cliente_create') }}">
                                    Registrarse
                                </a>
                            </p>
                        </div>
                    </form>
                    @endslot
                    @endcomponent


                    <a href="{{ route('cliente_create') }}" class="px-1 py-2 text-gray-500 hover:text-gray-100 hover:bg-gray-800 focus:bg-gray-800 focus:outline-none pr-1 transition duration-150 ease-in-out">Registrarse</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>