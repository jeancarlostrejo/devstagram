@extends('layouts.app')

@section('title')
    Inicia sesión en Devstagram
@endsection

@section('content')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login de usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}"  method="POST" novalidate>
                @csrf

                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 text-gray-500 font-bold">Correo
                    </label>
                    <input type="email" name="email" id="email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        placeholder="Ingresa tu correo" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 text-gray-500 font-bold">Contraseña
                    </label>
                    <input type="password" name="password" id="password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        placeholder="Ingrese una contraseña">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm">Mantener mi sesión activa</label>
                </div>
                <input type="submit" value="Iniciar sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
