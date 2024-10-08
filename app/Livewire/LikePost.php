<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())){
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
        }

        $this->post = Post::withCount('likes')->find($this->post->id);
        $this->isLiked = !$this->isLiked;
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
