<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\Compras;
use App\Models\Comprador;


class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_home');
    }

    public function compradores(){
        $compradores = Comprador::all();

        return view('admin.compradores', compact('compradores'));
    }

    public function vendedores(){
        $vendedores = Vendedor::all();

        return view('admin.vendedores', compact('vendedores'));
    }

    public function produtos(){
        $produtos = Produto::all();

        return view('admin.produtos', compact('produtos'));
    }

    public function updateStatus(Request $request, Vendedor $vendedor)
    {
    $validatedData = $request->validate([
        'status' => 'required|in:ativo,rejeitado',
    ]);

    $vendedor->status = $validatedData['status'];
    $vendedor->save();

    return redirect()->back()->with('success', 'Status updated successfully.');
    }

    
}
