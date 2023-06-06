<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Comprador;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Session;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $vendedor = Vendedor::where('email', $request->email)->first();
        $comprador = Comprador::where('email', $request->email)->first();
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
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email');
    }
}
