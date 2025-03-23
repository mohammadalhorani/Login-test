<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Auth\App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(): View
    {

        return view('auth::login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('/'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
       
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
