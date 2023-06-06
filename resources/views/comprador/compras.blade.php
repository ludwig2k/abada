@extends('layouts.header')

@section('content')
<div class="container">
    <h1>Comprador: {{ $comprador->nome }}</h1>

    <h2>Compras:</h2>
    @foreach ($comprador->compras as $compra)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Compra ID: {{ $compra->id }}</h5>
            <p class="card-text">Product: {{ $compra->produto->nomeProduto }}</p>
            <p class="card-text">Price: ${{ $compra->produto->preco }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
