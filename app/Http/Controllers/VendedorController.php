<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\Compras;
use App\Models\Comprador;

class VendedorController extends Controller
{
    public function meusProdutos(Request $request){
        $vendedorId = Session::get('vendedor_id');
        $vendedor = Vendedor::find($vendedorId);
        if (!$vendedor || !$vendedor->produtos || $vendedor->produtos->isEmpty()) {
            $produtos = collect(); 
            return view('vendedor.produtos', compact('produtos'))->with('alert', 'Você não tem produtos cadastrados.');
        }
        
        $produtos = $vendedor->produtos();
        

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

        return view('vendedor.produtos', compact('produtos', 'categories', 'vendedor'));
    }

    public function cadastroIndex(){

        return view('vendedor.cadastro_produto');
    }

    public function produtoStore(Request $request){

    $vendedor = Session::get('vendedor_id');
    $produto = new Produto();
    $produto->vendedor()->associate($vendedor);
    $produto->nomeProduto = $request->input('nomeProduto');
    $produto->descricao = $request->input('descricao');
    $produto->preco = $request->input('preco');
    $produto->categoria = $request->input('categoria');
    if ($request->hasFile('imagem')) {
        $images = [];
        foreach ($request->file('imagem') as $file) {
            $filePath = $file->store('images'); // Adjust the storage path as needed
            $images[] = $filePath;
        }
        $produto->imagem = json_encode($images);
    }
    $produto->save();

    return redirect()->route('vendedor.produtos')->with('produtoSalvo', '402');
    }
}
