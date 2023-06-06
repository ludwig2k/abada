<x-guest-layout>
    <form action="{{route('produto.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <input type="hidden" id="produtoId" name="produtoId" value="{{$produto->id}}">
        <div id="produtoFields">
            <div class="mt-4">
                <x-input-label for="nomeProduto" :value="__('Nome do Produto')" />
                <x-text-input id="nomeProduto" class="block mt-1 w-full" type="text" name="nomeProduto" :value="$produto->nomeProduto" />
                <x-input-error :messages="$errors->get('nomeProduto')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="descricao" :value="__('Descrição')" />
                <x-text-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="$produto->descricao" />
                <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="preco" :value="__('Preço')" />
                <x-text-input id="preco" class="block mt-1 w-full" type="number" name="preco" :value="$produto->preco" />
                <x-input-error :messages="$errors->get('preco')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="categoria" :value="__('Categoria')" />
                <x-text-input id="categoria" class="block mt-1 w-full" type="text" name="categoria" :value="$produto->categoria" />
                <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
            </div>
            

            <div class="mt-4">
                <x-input-label for="imagem" :value="__('Imagens')" />
                <input id="imagem" class="block mt-1 w-full" type="file" name="imagem[]" multiple />
                <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
            </div>
            
        </div>
        
        
    
    <br>
            <x-primary-button class="ml-4">
                {{ __('Enviar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>