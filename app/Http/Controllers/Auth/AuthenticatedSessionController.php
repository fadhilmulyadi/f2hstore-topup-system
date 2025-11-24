<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- LOGIKA REDIRECT MULAI DARI SINI ---
        
        /** * OPSI 1: Jika Anda punya kolom 'role' atau 'usertype' di database users
         * Pastikan di tabel users ada kolom 'role' yang isinya 'admin' atau 'user'
         */
        if ($request->user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        /**
         * OPSI 2: Jika Anda malas buat kolom role dan cuma Anda adminnya (Hardcode Email)
         * Ganti email di bawah dengan email login admin Anda
         */
        // if ($request->user()->email === 'admin@example.com') {
        //     return redirect()->intended(route('admin.dashboard'));
        // }

        // Jika bukan admin, lempar ke Homepage ("/")
        return redirect()->intended(url('/'));
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
