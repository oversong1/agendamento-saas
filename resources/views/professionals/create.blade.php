<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Profissional</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('professionals.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" value="Nome" />
                        <x-text-input id="name" name="name" class="block mt-1 w-full" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="E-mail" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" value="Telefone" />
                        <x-text-input id="phone" name="phone" class="block mt-1 w-full" :value="old('phone')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="bio" value="Bio" />
                        <textarea id="bio" name="bio" class="block mt-1 w-full border-gray-300 rounded-md">{{ old('bio') }}</textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>