<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Ator</title>
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

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-extrabold text-blue-600 mb-6 text-center">
            🎭 Detalhes do Ator
        </h1>

        <div class="space-y-4 text-gray-700">
            <p><strong>Nome:</strong> {{ $actor->name }}</p>
            <p><strong>Data de nascimento:</strong> {{ $actor->birthdate }}</p>
            <p><strong>Biografia:</strong><br>{{ $actor->bio ?: 'Biografia não disponível.' }}</p>
        </div>

        <div class="mt-6 flex justify-between gap-4">
            <a href="{{ route('actors.index') }}"
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
               Voltar
            </a>

            <div class="flex gap-2">
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
    </div>

</body>
</html>

