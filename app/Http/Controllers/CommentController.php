<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, User $user, Post $post):RedirectResponse
    {
        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment
        ]);

        return back()->with('message', 'Comentario realizado correctamente');
    }
}
