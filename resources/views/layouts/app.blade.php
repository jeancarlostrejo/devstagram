<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('title')</title>
        @vite('./resources/css/app.css')
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow sticky top-0">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">Devstagram</h1>
                @auth
                    <nav class="flex gap-2 items-center">
                        <a href="#" class="font-bold text-gray-600 text-sm">Hola: <span class="font-normal">{{ auth()->user()->username }}</span></a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a  href="{{ route('logout') }}" class="font-bold uppercase text-gray-600 text-sm" onclick="event.preventDefault(); this.closest('form').submit()">
                                Cerrar sesión
                            </a>
                        </form>
                    </nav>
                @else
                    <nav class="flex gap-2 items-center">
                        <a href="/login" class="font-bold uppercase text-gray-600 text-sm">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">Registrarse</a>
                    </nav>
                @endauth
            </div>
        </header>
        
        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">@yield('title')</h2>
            @yield('content')
        </main>

        <footer class=" mt-10 text-center p-5 text-gray-600 font-bold uppercase">
            Devstagram - Todos los derechos reservados {{ now()->year }}
        </footer>
    </body>
</html>
