@extends('layouts.header')
@section('content')
@if(session('compraConcluida'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Seu pedido foi realizado, obrigado!',
        showConfirmButton: false,
        timer: 5000
    })
</script>
@endif
<div class="row">
    <div class="col-md-12">
        <h3>Filtros</h3>
    </div>
    <div class="col-md-3">
        <form action="{{ route('loja.home') }}" method="GET">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Digite">
            </div>

            <div class="form-group">
                <label for="price">Preço:</label>
                <select name="price" id="price" class="form-control">
                    <option value="">Todos</option>
                    <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>Low to High</option>
                    <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>High to Low</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Todas</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('loja.home') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
    </div>

    <div class="col-md-9">
        <div class="row">
            @foreach ($produtos as $produto)
                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 20px; margin-bottom: 10px;">
                    <div class="card img_thumbnail card-container" style="width: 18rem;">
                        @php
                            $images = json_decode($produto->imagem);
                        @endphp

                        @if (!empty($images) && is_array($images) && count($images) > 0)
                            <img src="{{ $images[0] }}" class="card-img-top" alt="Product Image" style="width: 100%; height: auto;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $produto->nomeProduto }}</h5>
                            <p class="card-text">{{ $produto->descricao }}</p>
                            <p class="card-text"><strong>Price: </strong> ${{ $produto->preco }}</p>
                            <a href="{{route('produto.ver', $produto->id)}}" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .custom-pagination {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .card {
        box-shadow: 0px 10px 30px rgb(0 0 0 / 10%);
        border-radius: 50px;
        height: 100%;
        width: 70%;
        overflow: hidden;
    }

    .img_thumbnail {
        position: relative;
        padding: 0px;
        margin-bottom: 20px;
    }

    .img_thumbnail .card-body{
        margin: 7px;
        text-align: center;
    }

    .card-container {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>

<div class="custom-pagination">
    {{ $produtos->links() }}
</div>

@endsection
