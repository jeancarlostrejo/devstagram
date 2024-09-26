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
                <nav class="flex gap-2 items-center">
                    <a href="/login" class="font-bold uppercase text-gray-600 text-sm">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">Registrarse</a>
                </nav>
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
