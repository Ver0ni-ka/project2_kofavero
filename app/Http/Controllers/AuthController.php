<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login(): View
    {
        //s23kofavero : $2y$12$lzZryx.J7VcMbgwJcZrYgOlqFQhLMobHAGy2UWZbF.KkBgKj/Tife


        return view('auth.login', [
            'title' => 'Log in'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/architects');
        }

        return back()->withErrors([
            'name' => 'Failed to authenticate',
        ]);
    }

        // end user session
    public function logout(Request $request): RedirectResponse
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
    }

    

}

