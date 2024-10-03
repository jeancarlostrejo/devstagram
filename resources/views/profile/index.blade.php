@extends('layouts.app')

@section('title')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class=" md:flex md:justify-center">
        <div class=" md:w-6/12 bg-white shadow p-6">
            <form action="{{ route('profile.update', auth()->user()) }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                @method('PATCH')
                <div class="mb-5">
                    <label for="name" class="mb-2 text-gray-500 font-bold">Nombre
                    </label>
                    <input type="text" name="name" id="name" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        placeholder="Ingresa tu nombre" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 text-gray-500 font-bold">Nombre de usuario
                    </label>
                    <input type="text" name="username" id="username" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        placeholder="Ingrese un nombre de usuario" value="{{ old('username', auth()->user()->username) }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="image" class="mb-2 text-gray-500 font-bold">Imagen de perfil
                    </label>
                    <input type="file" name="image" id="image" class="border p-3 w-full rounded-lg @error('image') border-red-500 @enderror" accept=".jpg, .png, .jpeg, .gif">
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Actualizar perfil" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection