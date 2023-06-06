<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comprador;
use App\Models\Vendedor;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

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

        $comprador = Comprador::where('email', $request->email)->first();
        $vendedor = Vendedor::where('email', $request->email)->first();
        if ($comprador) {
            Session::put('comprador_id', $comprador->id);
            return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(RouteServiceProvider::HOME)
                : view('auth.verify-email');
        }
        if ($vendedor) {
            Session::put('vendedor_id', $vendedor->id);
            return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(RouteServiceProvider::VENDEDOR)
                : view('auth.verify-email');
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

        Session::flush();

        return redirect('/');
    }
}
