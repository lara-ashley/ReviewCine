<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gêneros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-xl font-bold">🎬 ReviewCine - Gêneros</h1>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('movies.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

        <h1 class="text-3xl font-extrabold text-indigo-600 mb-6 text-center">Gêneros de Filmes 🎬</h1>

        @if (session('success'))
            <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-center mb-6">
            <a href="{{ route('genres.create') }}"
               class="inline-block bg-indigo-600 text-white font-semibold px-6 py-3 rounded-full shadow hover:bg-indigo-700 transition-all duration-300">
               ➕ Novo Gênero
            </a>
        </div>

        <div class="space-y-4">
            @forelse ($genres as $genre)
                <div class="border rounded-2xl p-4 shadow flex justify-between items-center hover:shadow-lg transition">
                    <div>
                        <h2 class="text-xl font-bold text-indigo-700">{{ $genre->name }}</h2>
                        <p class="text-gray-600">{{ $genre->description }}</p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('genres.edit', $genre) }}"
                           class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition">
                           Editar
                        </a>

                        <form action="{{ route('genres.destroy', $genre) }}" method="POST" onsubmit="return confirm('Excluir gênero?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center">Nenhum gênero cadastrado.</p>
            @endforelse
        </div>

    </div>

</body>
</html>
