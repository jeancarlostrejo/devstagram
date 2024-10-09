<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentsBox extends Component
{
    public $post;
    public $comments;

    #[Validate('required|min:3|max:255')] 
    public $newMessage='';

    public function mount($post)
    {
        $this->post =  $post;

        $this->comments = Comment::with('user')->where('post_id', $this->post->id)->latest()->get();
    }

    public function store()
    {
        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $this->newMessage,
        ]);

        $this->comments = Comment::with('user')->where('post_id', $this->post->id)->latest()->get();

        $this->newMessage='';
    }

    public function render()
    {
        return view('livewire.comments-box');
    }
}
