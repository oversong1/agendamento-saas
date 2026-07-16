<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Serviço</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" value="Nome do serviço" />
                        <x-text-input id="name" name="name" class="block mt-1 w-full" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Descrição" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="duration_minutes" value="Duração (minutos)" />
                        <x-text-input id="duration_minutes" name="duration_minutes" type="number" class="block mt-1 w-full" :value="old('duration_minutes')" required />
                        <x-input-error :messages="$errors->get('duration_minutes')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" value="Preço (R$)" />
                        <x-text-input id="price" name="price" type="number" step="0.01" class="block mt-1 w-full" :value="old('price')" />
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>