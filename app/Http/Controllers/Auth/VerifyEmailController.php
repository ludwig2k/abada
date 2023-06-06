<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Comprador;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            if ($request->user()->role === 'comprador') {
                $comprador = Comprador::where('email', $request->user()->email)->first();

                if ($comprador) {
                    $comprador->creditos += 10000;
                    $comprador->save();
                }
            }
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
