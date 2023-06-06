<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\Compras;
use App\Models\Comprador;


class LojaController extends Controller
{
    public function index(Request $request)
{
    $query = Produto::query();

    $name = $request->input('name');
    if ($name) {
        $query->where('nomeProduto', 'like', '%' . $name . '%');
    }

    $price = $request->input('price');
    if ($price == 'asc') {
        $query->orderByRaw("CAST(preco AS DECIMAL(10,2)) ASC");
    } elseif ($price == 'desc') {
        $query->orderByRaw("CAST(preco AS DECIMAL(10,2)) DESC");
    }

    $category = $request->input('category');
    if ($category) {
        $query->where('categoria', $category);
    }

    $categories = $query->pluck('categoria')->unique()->filter()->toArray();

    $produtos = $query->paginate(10);

    return view('loja_home', compact('produtos', 'categories'));
}

public function verificaEmail(){

    return view('auth.verify-email');
}

public function checkout(Request $request){

    $produtoId = $request->input('produto_id');
    $vendedorId = $request->input('vendedor_id');

    $comprador = Comprador::find($request->user()->id);
    $vendedor = Vendedor::find($vendedorId);
    $produto = Produto::find($produtoId); 

    
    
    $compra = new Compras();
    $compra->vendedor_id = $vendedorId; 
    $compra->comprador_id = $request->user()->id; 
    $compra->produto_id = $produtoId;
    $comprador->creditos -= $produto->preco;
    $vendedor->creditos += $produto->preco;
    $comprador->save();
    $vendedor->save();
    $compra->save();

    return redirect()->route('loja.home')->with('compraConcluida', '402');

}

}
