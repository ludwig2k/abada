<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprador;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class CompradorController extends Controller
{
    public function editComprador()
{
    $compradorId = Session::get('comprador_id');

    $comprador = Comprador::find($compradorId);

    return view('comprador/edit_comprador', compact('comprador'));
}

    public function updateComprador(Request $request)
{
        $compradorId = Session::get('comprador_id');
        $comprador = Comprador::find($compradorId);

        if ($comprador) {
            $comprador->nome = $request->input('nome');
            $comprador->email = $request->input('email');
            $comprador->senha = Hash::make($request->senha);
            $comprador->cpf = $request->input('cpf');
            $comprador->data_nascimento = $request->input('data_nascimento');
            $comprador->estado = $request->input('estado');
            $comprador->cidade = $request->input('cidade');
            $comprador->save();
            
            return redirect()->route('loja.home');
        } 
}

    public function mostrarCompras(){

        $compradorId = Session::get('comprador_id');
        $comprador = Comprador::find($compradorId);
        $comprador = Comprador::with('compras')->find($compradorId);
        return view('comprador.compras', compact('comprador'));

    }
}
