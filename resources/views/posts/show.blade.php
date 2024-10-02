@extends('layouts.app')

@section('title')
    Post: {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
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

            @auth
                @can ('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endcan
            @endauth
        </div>


        <div class="md:w-6/12 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                    @if (session('message'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="POST">
                        @csrf
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

                <div class="bg-white shadow mb5 max-h-96 overflow-y-scroll mt-10">
                    @forelse ($post->comments as $comment)
                         <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">{{ $comment->user->username }}</a>
                            <p>{{ $comment->comment }}</p>
                            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                         </div>
                    @empty
                        <p class="p-10 text-center">No hay comentarios aún</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection