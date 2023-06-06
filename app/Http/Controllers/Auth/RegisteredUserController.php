<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Comprador;
use App\Models\Vendedor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->role === 'comprador') {
            $comprador = Comprador::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'cpf' => $request->cpf,
                'data_nascimento' => $request->data_nascimento,
                'estado' => $request->estado,
                'cidade' => $request->cidade,
                'creditos' => 0,
            ]);

            $user = User::create([
                'name' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->senha),
                'role' => $request->role,
            ]);

            event(new Registered($user));


            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }

        if ($request->role === 'vendedor') {
            Vendedor::create([
                'nome' => $request->nomeVendedor,
                'email' => $request->emailVendedor,
                'senha' => Hash::make($request->senhaVendedor),
            ]);

            $user = User::create([
                'name' => $request->nomeVendedor,
                'email' => $request->emailVendedor,
                'password' => Hash::make($request->senhaVendedor),
                'role' => $request->role,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }
    }
}
