@extends('layouts.app')

@section('title')
    Perfil: {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen del usuario">
            </div>
            <div class=" md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:py-10 md:items-start">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                <p class="text-gray-800 text-sm mt-5">0 <label class="font-normal">Seguidores</label></p>
                <p class="text-gray-800 text-sm">0 <label class="font-normal">Siguiendo</label></p>
                <p class="text-gray-800 text-sm">0 <label class="font-normal">Posts</label></p>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a>
                            <img src="{{ Storage::url('posts/') . $post->image }}" alt="Imagen del post {{ $post->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="tex-white mt-5">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section>
@endsection