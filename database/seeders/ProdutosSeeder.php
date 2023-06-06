<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\User;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://dummyjson.com/products');
        $responseData = $response->json();

        $seller = Vendedor::create([
            'nome' => 'Vendedor Fulano',
            'email' => 'vendedor@gmail.com',
            'senha' => bcrypt('vendedorteste1234'),
            'status' => 'ativo',
            'creditos' => '15000',
        ]);

        User::create([
            'name' => 'Vendedor Fulano',
            'email' => 'vendedor@gmail.com',
            'password' => bcrypt('vendedorteste1234'),
            'role' => 'vendedor',
            'email_verified_at' => now(),
        ]);

        $productsData = $responseData['products'];

        foreach ($productsData as $productData) {
            $product = new Produto();
            $product->vendedor_id = $seller->id;
            $product->nomeProduto = $productData['title'];
            $product->descricao = $productData['description'];
            $product->preco = $productData['price'];
            $product->categoria = $productData['category'];
            $product->imagem = json_encode($productData['images']);
            $product->save();
        }
    }
}
