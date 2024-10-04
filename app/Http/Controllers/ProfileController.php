<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UploadImageService;

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
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            $nameImage = UploadImageService::upload($request->file('image'),'profiles', $user);
        }

        $validated['image'] = $nameImage ?? $user->image ?? null;

        $user->fill($validated);
        $user->save();

        return to_route('posts.index', $user);
    }
}
