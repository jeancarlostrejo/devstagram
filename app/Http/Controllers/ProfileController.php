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

        if (!auth()->attempt(['email' => auth()->user()->email, 'password' => $request->password])) {
            return back()->with('message', 'Incorrect password, is not possible update your profile information');
        }

        if ($request->hasFile('image') && !$request->notImage) {
            $nameImage = UploadImageService::upload($request->file('image'),'profiles', $user);
        }

        if($request->notImage){
            UploadImageService::delete('profiles/' . $user->image);
            $user->image = null;
        }

        $validated['image'] = $nameImage ?? $user->image ?? null;

        $user->fill($validated);
        $user->save();

        return to_route('posts.index', $user)->with('message', 'Se ha actualizado tu información de perfil');
    }
}
