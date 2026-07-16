<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Serviços
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('services.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    + Novo Serviço
                </a>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Nome</th>
                            <th class="py-2">Duração</th>
                            <th class="py-2">Preço</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr class="border-b">
                                <td class="py-2">{{ $service->name }}</td>
                                <td class="py-2">{{ $service->duration_minutes }} min</td>
                                <td class="py-2">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                                <td class="py-2">
                                    {{ $service->is_active ? 'Ativo' : 'Inativo' }}
                                </td>
                                <td class="py-2">
                                    <a href="{{ route('services.edit', $service) }}" class="text-indigo-600">Editar</a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Tem certeza?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2">Remover</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $services->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>