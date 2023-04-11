<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        

        <!-- Styles -->
        @livewireStyles

        @wireUiScripts
        <script src="//unpkg.com/alpinejs" defer></script>
        
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        {{-- Side Menu --}}
        <aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-slate-700 transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
            <div>
                <div class="px-6 py-4 -mx-6">
                    <a href="{{ route('dashboard') }}" title="home" class="text-2xl font-black text-gray-50">
                        Pangkalan Gas Elpiji Herman
                    </a>
                </div>
    
                <ul class="mt-8 space-y-2 tracking-wide">
                    <li>
                        <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-700 bg-gray-50 font-semibold' : 'px-4 py-3 flex items-center space-x-4 rounded-md text-gray-50 group font-semibold' }}">
                            <span class="-mr-1">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.index') }}" class="{{ Route::is('transactions.index') ? 'relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-700 bg-gray-50 font-semibold' : 'px-4 py-3 flex items-center space-x-4 rounded-md text-gray-50 group font-semibold' }}">
                            <span>Daftar Transaksi</span>
                        </a>
                    </li>
                    @if(Auth::user()->is_admin == 1)
                    <li>
                        <a href="{{ route('members.index') }}" class="{{ Route::is('members.index') ? 'relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-700 bg-gray-50 font-semibold' : 'px-4 py-3 flex items-center space-x-4 rounded-md text-gray-50 group font-semibold' }}">
                            <span>Daftar Pelanggan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}" class="{{ Route::is('account') ? 'relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-700 bg-gray-50 font-semibold' : 'px-4 py-3 flex items-center space-x-4 rounded-md text-gray-50 group font-semibold' }}">
                            <span>Daftar Akun</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </aside>

        <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    </body>
</html>
