@props(['posts'])

<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-3 sm:p-0">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                        <img src="{{ Storage::url('posts/') . $post->image }}" alt="Imagen del post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="tex-white mt-5 px-3 sm:p-0">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts, sigue a alguien para mostrar sus posts</p>
    @endif
</div>