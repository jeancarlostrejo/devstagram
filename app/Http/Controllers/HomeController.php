<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __invoke(Request $request)
    {
        $ids = (auth()->user()->followings->pluck('id')->toArray());

        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
        $posts->load('user');

        return view('home', compact('posts'));
    }
}
