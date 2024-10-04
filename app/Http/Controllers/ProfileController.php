<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\UpdateUserProfileRequest;


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
            if ($user->image) {
                if (File::exists(Storage::path('profiles/' . $user->image))) {
                    Storage::delete('profiles/' . $user->image);
                }
            }

            $image = $request->file('image');
            $nameImage = Str::uuid() . "." . $image->extension();
            $imagePath = storage_path('app/public/profiles') . '/' . $nameImage;

            $serverImage = Image::read($image);
            $serverImage->resize(1000, 1000);
            $serverImage->save($imagePath);
        }

        $validated['image'] = $nameImage ?? $user->image ?? null;

        $user->fill($validated);
        $user->save();

        return to_route('posts.index', $user);
    }
}
