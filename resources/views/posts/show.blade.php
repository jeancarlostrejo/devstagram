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

        <div class="md:w-6/12">
            2
        </div>
    </div>
@endsection