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
                    <livewire:like-post :$post/>
                @endauth
            </div>

            <div>
                <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500" title="{{ $post->created_at->format('d-m-Y h:i a') }}"> {{ $post->created_at->diffForHumans() }}</p>
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
                <livewire:comments-box :$post/>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/deleteConfirmation.js') }}"></script>
@endsection()
    