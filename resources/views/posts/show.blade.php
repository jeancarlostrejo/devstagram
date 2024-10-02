@extends('layouts.app')

@section('title')
    Post: {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto flex">
        <div class="md:w-6/12">
            <img src="{{ Storage::url('posts/') . $post->image }}" alt="Imagen del post {{ $post->title }}">

            <div class="p-3">
                <p>0 Likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500"> {{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5"> {{ $post->description }}</p>
            </div>
        </div>

        <div class="md:w-6/12 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>
                    <form action="">
                        <div class="mb-5">
                        <label for="comment" class="mb-2 text-gray-500 font-bold text-sm">Añade un comentario
                        </label>
                        <textarea name="comment" id="comment" class="border p-3 w-full rounded-lg resize-none @error('comment') border-red-500 @enderror"
                        placeholder="Agrega un comentario"></textarea>
                        @error('comment')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror

                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection