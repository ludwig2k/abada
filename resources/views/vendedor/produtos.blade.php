@extends('layouts.header')

@section('content')
@if(session('alert'))
    <div class="alert alert-warning">
        {{ session('alert') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif
@if(session('produtoSalvo'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Seu produto foi registrado!',
        showConfirmButton: false,
        timer: 5000
    })
</script>
@endif
<div class="container">
    @if ($produtos->isEmpty())
                <div class="alert alert-info">
                    Você não tem produtos cadastrados.
                </div>
            @else
    <div class="row">
        <div class="col-md-3">
            <form action="{{ route('vendedor.produtos') }}" method="GET">
                <h3>Filtros</h3>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Digite">
                </div>

                <div class="form-group">
                    <label for="price">Preço:</label>
                    <select name="price" id="price" class="form-control">
                        <option value="">Todos</option>
                        <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>Menor pra maior</option>
                        <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>Maior pra menor</option>
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
                    <a href="{{ route('vendedor.produtos') }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <h2>Meus Produtos:</h2>
            <div class="row">
                @foreach ($vendedor->produtos as $produto)
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
                                <p class="card-text"><strong>Preço: </strong> ${{ $produto->preco }}</p>
                                <a href="{{route('produto.editar', $produto->id)}}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
