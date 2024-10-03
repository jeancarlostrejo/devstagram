@extends('layouts.app')

@section('title')
    Post: {{ $post->title }}
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
    <div class="container mx-auto md:flex">
        <div class="md:w-6/12 p-3 sm:p-0">
            <img src="{{ Storage::url('posts/') . $post->image }}" alt="Imagen del post {{ $post->title }}">

            <div class="p-3 flex items-center gap-4">
                @auth
                    @if ($post->checkLike(auth()->user()))
                        <form action="{{ route('posts.like.destroy', $post) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('posts.like.store', $post) }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                @endauth
                <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">Likes</span></p>
            </div>

            <div>
                <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500"> {{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5"> {{ $post->description }}</p>
            </div>

            @auth
                @can ('delete', $post)
                    <form id="form-delet" action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endcan
            @endauth
        </div>

        <div class="md:w-6/12 p-3">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

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

@section('scripts')
    <script src="{{ asset('js/deleteConfirmation.js') }}"></script>
@endsection()
    