<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    
    public function index(User $user): View
    {
        $posts = Post::where('user_id', $user->id)->paginate(15);

        return view('dashboard', compact('user', 'posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        auth()->user()->posts()->create($request->validated());

        return to_route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        $post->load('comments.user');
        
        return view('posts.show', compact('post', 'user'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();
        
        if(File::exists(Storage::path('posts/' . $post->image))){
            Storage::delete('posts/' . $post->image);
        }
        
        return to_route('posts.index', auth()->user()->username);
    }
}
