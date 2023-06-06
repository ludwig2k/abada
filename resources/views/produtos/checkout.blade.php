@extends('layouts.header')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
        <input type="hidden" name="vendedor_id" value="{{ $produto->vendedor_id }}">

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                @php
                $images = json_decode($produto->imagem);
                @endphp

                @if (!empty($images) && is_array($images) && count($images) > 0)
                <img src="{{ $images[0] }}" class="card-img-top" alt="Product Image" style="width: 120px; height: 120px;">
                @endif
            </li>
            <li class="list-group-item">Nome do produto: <strong>{{ $produto->nomeProduto }}</strong></li>
            <li class="list-group-item">Preço: <strong>${{ $produto->preco }}</strong></li>
            <li class="list-group-item">
                <button type="submit" class="btn btn-success">Finalizar compra</button>
            </li>
        </ul>
    </form>
</div>
@endsection
