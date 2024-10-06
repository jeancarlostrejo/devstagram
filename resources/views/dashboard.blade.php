@extends('layouts.app')

@section('title')
    Perfil: {{ $user->username }}
@endsection

@push('styles')
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetAlertToast.css') }}">
@endpush

@section('content')
@if (session('message'))
    <script src="{{ asset('js/toast.js') }}"></script>
    <script>
        Toast.fire({
            icon: "success",
            title: "{{ session('message') }}",
        });
    </script>
@endif
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->image ? Storage::url('profiles/' . $user->image) : asset('img/usuario.svg') }}" alt="Imagen del usuario">
            </div>
            <div class=" md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:py-10 md:items-start">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                        @can ('view', $user)
                            <a href="{{ route('profile.index', $user->username) }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                </svg>
                            </a>
                        @endcan
                    @endauth

                </div>
                <p class="text-gray-800 text-sm mt-5">0 <span class="font-normal">Seguidores</span></p>
                <p class="text-gray-800 text-sm">0 <span class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm font-bold">{{ $user->posts->count() }} <span class="font-normal">Posts</span></p>

                @auth
                    @if($user->id !== auth()->user()->id)
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs
                            font-bold cursor-pointer" value="Seguir">
                        </form>
                        <form action="" method="POST">
                            @csrf
                            <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs
                            font-bold cursor-pointer" value="Dejar de seguir">
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-3 sm:p-0">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['user' => $user, 'post' => $post]) }}">
                            <img src="{{ Storage::url('posts/') . $post->image }}" alt="Imagen del post {{ $post->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="tex-white mt-5 px-3 sm:p-0">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section>
@endsection