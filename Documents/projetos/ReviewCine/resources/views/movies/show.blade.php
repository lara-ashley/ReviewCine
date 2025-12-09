<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($filme) ? 'Editar Filme' : 'Cadastrar Filme' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-6">

<nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-xl font-bold">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-indigo-100">
                🎬 ReviewCine
            </a>
        </h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('movies.index') }}" class="bg-indigo-700 px-4 py-2 rounded-lg transition hover:bg-indigo-800">Filmes</a>
            <a href="{{ route('actors.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
            <a href="{{ route('filmmakers.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
            <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
            <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
        </div>
    </div>
</nav>
<div class="max-w-5xl mx-auto p-6 bg-blue-50 min-h-screen">

    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <h1 class="text-3xl font-bold text-indigo-600 mb-2">{{ $movie->titulo }}</h1>

        <p class="text-gray-600 mb-2">
            Lançamento: {{ optional($movie->data_lancamento)->format('d/m/Y') ?? 'Não informado' }}
        </p>

        <p class="text-gray-600 mb-2">
            Onde assistir: {{ $movie->onde_assistir ?? 'Não informado' }}
        </p>

        <p class="text-gray-600 mb-2">
            Cineastas: {{ $movie->filmmakers->pluck('nome')->join(', ') ?? 'Não informado' }}
        </p>

        <p class="text-gray-600 mb-2">
            Atores: {{ $movie->actors->pluck('nome')->join(', ') ?? 'Não informado' }}
        </p>

        <p class="text-gray-600 mb-4">
            Gêneros: {{ $movie->genres->pluck('nome')->join(', ') ?? 'Não informado' }}
        </p>

        <p class="text-gray-600 mb-4">{{ $movie->sinopse ?? 'Sinopse não disponível.' }}</p>

        <h2 class="text-xl font-semibold text-indigo-600 mb-3">
            Comentários ({{ $movie->comments->count() }})
        </h2>

        @if($movie->comments->isNotEmpty())
            @foreach($movie->comments as $comment)
                <div class="mb-2 p-2 border-l-4 border-blue-300 bg-blue-50 rounded hover:bg-blue-100 transition">
                    <p class="text-gray-700">
                        <strong>{{ $comment->autor }}:</strong> {{ Str::limit($comment->conteudo, 100) }}
                    </p>

                    @auth
                        @if(auth()->id() === $comment->user_id)
                            <div class="mt-1 flex gap-2">
                                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Tem certeza que deseja deletar este comentário?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Deletar</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Nenhum comentário ainda.</p>
        @endif

        @auth
            <form action="{{ route('movies.comments.store', $movie->id) }}" method="POST" class="mt-4 space-y-2">
                @csrf
                <textarea name="conteudo" rows="3" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" required>{{ old('conteudo') }}</textarea>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">Adicionar comentário</button>
            </form>
        @else
            <p class="text-gray-500 mt-2">Você precisa estar logado para comentar.</p>
        @endauth

    </div>

</div>
<body>
</html>