<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Si el usuario autenticado es admin, redirigir siempre al dashboard administrativo
        $user = Auth::user();
        if ($user && (($user->role ?? null) === 'admin')) {
            // Eliminar cualquier "intended" previo y forzar redirección al dashboard admin
            // para evitar que redirect()->intended nos lleve a la otra dashboard.
            $request->session()->forget('url.intended');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirigir explícitamente al login para mayor claridad
        return redirect()->route('login');
    }
}
