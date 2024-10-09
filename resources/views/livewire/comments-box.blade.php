<div>
    @auth
        <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>
            <div class="mb-5">
                <label for="newMessage" class="mb-2 text-gray-500 font-bold text-sm">Añade un comentario
                </label>
                <textarea wire:model='newMessage' name="newMessage" id="newMessage" class="border p-3 w-full rounded-lg resize-none @error('newMessage') border-red-500 @enderror"
                placeholder="Agrega un comentario"></textarea>
                @error('newMessage')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <button wire:click='store' class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white text-center rounded-lg">Comentar</button>
            </div>
        </form>
    @endauth

    <div class="bg-white shadow mb5 max-h-96 overflow-y-scroll mt-10">
        @forelse ($comments as $comment)
                <div class="p-5 border-gray-300 border-b">
                <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">{{ $comment->user->username }}</a>
                <p>{{ $comment->comment }}</p>
                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
        @empty
            <p class="p-10 text-center">No hay comentarios aún</p>
        @endforelse
    </div>
    <div class="tex-white mt-5 px-3 sm:p-0">{{ $comments->links(data: ['scrollTo' => false]) }}</div>
</div>
