<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profissionais
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

                <a href="{{ route('professionals.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    + Novo Profissional
                </a>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Nome</th>
                            <th class="py-2">E-mail</th>
                            <th class="py-2">Telefone</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($professionals as $professional)
                            <tr class="border-b">
                                <td class="py-2">{{ $professional->name }}</td>
                                <td class="py-2">{{ $professional->email }}</td>
                                <td class="py-2">{{ $professional->phone }}</td>
                                <td class="py-2">
                                    {{ $professional->is_active ? 'Ativo' : 'Inativo' }}
                                </td>
                                <td class="py-2">
                                    <a href="{{ route('professionals.edit', $professional) }}" class="text-indigo-600">Editar</a>
                                    <form action="{{ route('professionals.destroy', $professional) }}" method="POST" class="inline"
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
                    {{ $professionals->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>