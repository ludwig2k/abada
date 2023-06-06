<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Auth\Factory as Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            if ($request->expectsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('login');
            }
        }

        if ($request->user() && $request->user()->role !== 'admin') {
            return redirect()->route('loja.home')->withErrors('Unauthorized access');
        }


        return $next($request);
    }
}
