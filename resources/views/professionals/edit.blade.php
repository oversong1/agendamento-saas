<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Profissional</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('professionals.update', $professional) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" value="Nome" />
                        <x-text-input id="name" name="name" class="block mt-1 w-full" :value="old('name', $professional->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="E-mail" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email', $professional->email)" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" value="Telefone" />
                        <x-text-input id="phone" name="phone" class="block mt-1 w-full" :value="old('phone', $professional->phone)" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="bio" value="Bio" />
                        <textarea id="bio" name="bio" class="block mt-1 w-full border-gray-300 rounded-md">{{ old('bio', $professional->bio) }}</textarea>
                    </div>

                    <div class="mb-4 flex items-center gap-2">
                        <input type="checkbox" id="is_active" name="is_active" value="1" @checked($professional->is_active) class="rounded border-gray-300">
                        <x-input-label for="is_active" value="Profissional ativo" />
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Salvar alterações
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>