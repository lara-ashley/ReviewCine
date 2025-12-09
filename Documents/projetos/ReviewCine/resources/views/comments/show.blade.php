<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentário de {{ $comment->autor }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-6">

<body class="bg-blue-50 min-h-screen p-6">

    <nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
            <h1 class="text-xl font-bold">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-indigo-100">
                    🎬 ReviewCine
                </a>
            </h1>            
            <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
                <a href="{{ route('movies.index') }}" class="bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-lg transition">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>        

    <h2 class="text-2xl font-bold text-blue-700 mb-4">Comentário de {{ $comment->autor }}</h2>

    <p class="text-gray-700 mb-4">{{ $comment->conteudo }}</p>

    <p class="text-gray-500 mb-4">
        Filme: 
            {{ $comment->movie->titulo }}
        </a>
    </p>

    @auth
        @if(auth()->id() === $comment->user_id)
            <div class="flex gap-2 mb-4">
                <a href="{{ route('comments.edit', $comment->id) }}" 
                   class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
                   ✏️ Editar
                </a>

                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" 
                      onsubmit="return confirm('Deseja realmente deletar este comentário?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                        🗑️ Deletar
                    </button>
                </form>
            </div>

            <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-4 space-y-2">
                @csrf
                @method('PUT')
                <textarea name="conteudo" rows="3" 
                          class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                          required>{{ old('conteudo', $comment->conteudo) }}</textarea>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                    Atualizar Comentário
                </button>
            </form>
        @endif
    @endauth

    <a href="{{ route('movies.index', $comment->movie_id) }}" class="text-blue-600 hover:underline mt-4 block">
        ← Voltar para o filme
    </a>
</div>

</body>
</html>
