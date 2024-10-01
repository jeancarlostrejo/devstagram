<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user): View
    {
        return view('dashboard', compact('user'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        dd('guardando posts');
    }
}
