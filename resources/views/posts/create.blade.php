@extends('layouts.app')

@section('title')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">

        <div class=" md:w-1/2 px-10">
            <form action="{{ route('images.stores') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-8 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 px-10 bg-white p-6 rounded-lg shadow-xl mt-0">
            <form action="" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 text-gray-500 font-bold">Título
                    </label>
                    <input type="text" name="title" id="title" class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror"
                    placeholder="Título de la publicación" value="{{ old('title') }}">
                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 text-gray-500 font-bold">Descripción
                    </label>
                    <textarea name="description" id="description" class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror"
                    placeholder="Descripción de la publicación" style="resize: none;">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear publicación" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection