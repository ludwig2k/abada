<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function verProduto($id)
    {
        $produto = Produto::find($id);
        if($produto){
            return view('produtos/produto', compact('produto'));
        }
        return redirect()->back();
    }

    public function checkout($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produtos/checkout', compact('produto'));
    }


    public function editar($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produtos.editar_produto', compact('produto'));
    }

    public function update(Request $request){

        $produtoId = $request->input('produtoId');
        $produto = Produto::find($produtoId);

        if($produto){
            $produto->nomeProduto = $request->input('nomeProduto');
            $produto->descricao = $request->input('descricao');
            $produto->preco = $request->input('preco');
            $produto->categoria = $request->input('categoria');
            $produto->save();
        }
        
        return redirect()->route('vendedor.produtos')->with('produtoSalvo', '402');

    }
}
