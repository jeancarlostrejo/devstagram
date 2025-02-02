<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Services\UploadImageService;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    
    public function index(User $user): View
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(15);
        $posts->load('user');

        return view('dashboard', compact('user', 'posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        auth()->user()->posts()->create($request->validated());

        return to_route('posts.index', auth()->user()->username)->with('message', '¡Publicación creada exitosamente!');
    }

    public function show(User $user, Post $post): View
    {
        $post->load('user')->loadCount('likes');

        $comments = $post->comments()->latest()->paginate(10);
        $comments->load('user');
        
        return view('posts.show', compact('post', 'user', 'comments'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        UploadImageService::delete('posts/' . $post->image);
        
        return to_route('posts.index', auth()->user()->username);
    }
}
