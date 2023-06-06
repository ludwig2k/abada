<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
    
        <!-- Name -->
    
        <div class="mt-4">
            <x-input-label for="role" :value="__('Tipo de conta')" />
            <select id="role" name="role" class="block mt-1 w-full" onchange="toggleCompradorFields(); toggleVendedorFields()" required>
                <option value="" selected></option>
                <option value="comprador">Comprador</option>
                <option value="vendedor">Vendedor</option>
                <!-- Add more role options as needed -->
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
    
        <div id="compradorFields" style="display: none;">
            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="senha" :value="__('Senha')" />
                <x-text-input id="senha" class="block mt-1 w-full" type="password" name="senha" />
                <x-input-error :messages="$errors->get('senha')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" />
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
                <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="old('data_nascimento')" />
                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="estado" :value="__('Estado')" />
                <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado')" />
                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="cidade" :value="__('Cidade')" />
                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade')" />
                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
            </div>
            
        </div>

        <div id="vendedorFields" style="display: none;">
            <div class="mt-4">
                <x-input-label for="nomeVendedor" :value="__('Nome')" />
                <x-text-input id="nomeVendedor" class="block mt-1 w-full" type="text" name="nomeVendedor" :value="old('nome')" />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="emailVendedor" :value="__('Email')" />
                <x-text-input id="emailVendedor" class="block mt-1 w-full" type="email" name="emailVendedor" :value="old('email')" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="senhaVendedor" :value="__('Senha')" />
                <x-text-input id="senhaVendedor" class="block mt-1 w-full" type="password" name="senhaVendedor" />
                <x-input-error :messages="$errors->get('senha')" class="mt-2" />
            </div>
            
        </div>
    
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Ja possui cadastro?') }}
            </a>
    
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function toggleCompradorFields() {
        var roleSelect = document.getElementById("role");
        var compradorFields = document.getElementById("compradorFields");

        if (roleSelect.value === "comprador") {
            compradorFields.style.display = "block";
        } else {
            compradorFields.style.display = "none";
        }
    }
</script>
<script>
    function toggleVendedorFields() {
        var roleSelect = document.getElementById("role");
        var vendedorFields = document.getElementById("vendedorFields");

        if (roleSelect.value === "vendedor") {
            vendedorFields.style.display = "block";
        } else {
            vendedorFields.style.display = "none";
        }
    }
</script>
