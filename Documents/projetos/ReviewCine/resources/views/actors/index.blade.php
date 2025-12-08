<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Atores</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-xl font-bold">🎬 ReviewCine - Atores</h1>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('movies.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto">

        <h1 class="text-4xl font-extrabold text-blue-600 text-center mb-6">🎭 Lista de Atores</h1>

        <div class="text-center mb-6">
            <a href="{{ route('actors.create') }}"
               class="bg-blue-600 text-white font-bold px-6 py-3 rounded-full shadow-lg transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1 hover:shadow-xl inline-block">
               ➕ Adicionar Ator
            </a>
        </div>

        @if(session('sucesso'))
            <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6 text-center">
                {{ session('sucesso') }}
            </div>
        @endif

        @if($actors->isEmpty())
            <p class="text-gray-500 text-center">Nenhum ator cadastrado ainda.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($actors as $actor)
                    <div class="bg-white border border-blue-200 rounded-2xl p-6 shadow hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-blue-700 mb-2">{{ $actor->name }}</h2>
                        <p class="text-gray-600 mb-2"><strong>Data de nascimento:</strong> {{ $actor->birthdate }}</p>
                        <p class="text-gray-700 mb-4">{{ $actor->bio ?: 'Biografia não disponível.' }}</p>

                        <div class="flex gap-2">
                            <a href="{{ route('actors.show', $actor) }}"
                               class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition">
                               Ver
                            </a>

                            <a href="{{ route('actors.edit', $actor) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                               Editar
                            </a>

                            <form action="{{ route('actors.destroy', $actor) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir este ator?')"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>
</html>
