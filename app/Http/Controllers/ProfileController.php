<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, User $user): View
    {
        $this->authorize('view', $user);

        return view('profile.index');
    }

    public function update(UpdateUserProfileRequest $request, User $user): RedirectResponse
    {
        dd('ok');
        $this->authorize('update', $user);

        return to_route('posts.index', $user);
    }
}
