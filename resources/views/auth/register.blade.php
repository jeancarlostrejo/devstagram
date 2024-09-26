@extends('layouts.app')

@section('title')
    Registrate en Devstagram
@endsection

@section('content')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/register.jpg') }}" alt="Imagen de registro de usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="">
                <div class="mb-5">
                    <label for="name" class="mb-2 text-gray-500 font-bold">Nombre
                    </label>
                    <input type="text" name="name" id="name" class="border p-3 w-full rounded-lg"
                        placeholder="Ingresa tu nombre">
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 text-gray-500 font-bold">Nombre de usuario
                    </label>
                    <input type="text" name="username" id="username" class="border p-3 w-full rounded-lg"
                        placeholder="Ingrese un nombre de usuario">
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 text-gray-500 font-bold">Correo
                    </label>
                    <input type="email" name="email" id="email" class="border p-3 w-full rounded-lg"
                        placeholder="Ingresa tu correo">
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 text-gray-500 font-bold">Contraseña
                    </label>
                    <input type="password" name="password" id="password" class="border p-3 w-full rounded-lg"
                        placeholder="Ingrese una contraseña">
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 text-gray-500 font-bold">Repetir contraseña
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="border p-3 w-full rounded-lg" placeholder="Repite la contraseña">
                </div>
                <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
