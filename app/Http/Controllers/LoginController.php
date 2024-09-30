<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }
    
    public function store(LoginRequest $request)
    {
        if (!auth()->attempt($request->only(['email', 'password']))) {
            return back()->with('message', 'Email or password incorrect');
        }

        $request->session()->regenerate();

        return to_route('wall.index');
    }
}
