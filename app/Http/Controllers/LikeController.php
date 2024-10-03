<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $post->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        return back();
    }
}
