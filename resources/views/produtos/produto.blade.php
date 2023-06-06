@extends('layouts.header')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="carousel-container">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-image">
                    @php
                        $images = json_decode($produto->imagem);
                    @endphp
                    @if (!empty($images) && is_array($images) && count($images) > 0)
                        @foreach ($images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $image }}" class="d-block w-100" alt="Product Image">
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        </div>
    </div>
        <div class="col-lg-6">
            <div class="product-details">
                <h1>{{ $produto->nomeProduto }}</h1>
                <h5><strong>Descrição: </strong></h5>
                <p>{{ $produto->descricao }}</p>
                <h5><strong>Preço: </strong> ${{ $produto->preco }}</h5>
                <a href="{{route('produto.checkout', ['id' => $produto->id])}}" class="btn btn-primary">Adicionar ao carrinho</a>
            </div>
        </div>
    
</div>


<style>
    .carousel-container {
    background-color: black;
    padding: 10px;
    display: inline-block;
}

    .carousel-image {
        width: 500px;
        height: 500px;
    }

    .container {
    position: absolute;
    left: 0;
    }
</style>
@endsection