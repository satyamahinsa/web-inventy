<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            session()->flash('loginstatus', 'Login berhasil!');

            $user = auth()->user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($user->role === 'user') {
                return redirect()->route('dashboard.user');
            }

            abort(403, 'Unauthorized access');
        }
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak valid.',
        ])->onlyInput('email'); 
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
