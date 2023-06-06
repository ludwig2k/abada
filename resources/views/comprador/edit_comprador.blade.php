<x-guest-layout>
    <form action="{{ route('comprador.update') }}" method="POST">
        @csrf
        @method('PUT')
    
        <div id="compradorFields">
            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="$comprador->nome" />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$comprador->email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="senha" :value="__('Senha')" />
                <x-text-input id="senha" class="block mt-1 w-full" type="password" name="senha" />
                <x-input-error :messages="$errors->get('senha')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="$comprador->cpf" />
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
                <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="$comprador->data_nascimento" />
                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="estado" :value="__('Estado')" />
                <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="$comprador->estado" />
                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="cidade" :value="__('Cidade')" />
                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="$comprador->cidade" />
                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
            </div>
        </div>
        
        
    
    <br>
            <x-primary-button class="ml-4">
                {{ __('Enviar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>