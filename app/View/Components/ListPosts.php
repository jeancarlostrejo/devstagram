<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class ListPosts extends Component
{
    //Como se está suando la paginación, la variable tiene que ser de tipo LengAwarePaginator
    public function __construct(public LengthAwarePaginator $posts)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-posts');
    }
}
