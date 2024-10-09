<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsBox extends Component
{
    use WithPagination;

    public $post;

    #[Validate('required|min:3|max:255')] 
    public $newMessage='';

    public function mount($post)
    {
        $this->post =  $post;
    }

    public function store()
    {
        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $this->newMessage,
        ]);

        $this->newMessage='';
    }

    public function render()
    {
        $comments = $this->post->comments()->latest()->paginate(10);
        $comments->load('user');

        return view('livewire.comments-box', compact('comments'));
    }
}
