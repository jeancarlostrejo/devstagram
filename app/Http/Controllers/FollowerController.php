<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);

        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('unfollow', $user);
        
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
