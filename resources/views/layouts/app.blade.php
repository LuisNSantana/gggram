<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>GGgram  - @yield('titulo')</title>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles


</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">

        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-sans font-extrabold">
                Gggram
            </a>
            @auth
                <nav class="flex gap-2 items-center">

                    <a href="{{ route('posts.create') }}"
                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Crear</a>

                    <a class="font-bold  text-gray-600 text-sm"
                        href="{{ route('posts.index', auth()->user()->username) }}">Hola: <span class="font-normal">
                            {{ auth()->user()->username }}</span></a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar sesion</button>
                    </form>

                </nav>
            @endauth
            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                </nav>
            @endguest

        </div>

    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')



    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Gggram - Todos los derechos reservados {{ now()->year }}


    </footer>
    @livewireScripts
</body>

</html>
