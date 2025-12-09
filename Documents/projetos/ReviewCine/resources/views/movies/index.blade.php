<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
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

    <div class="max-w-5xl mx-auto">

        <h1 class="text-4xl font-extrabold text-blue-600 text-center mb-6">🎬 Catálogo de Filmes</h1>
        <hr class="border-blue-200 mb-8">

        @if(session('sucesso'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 p-4 rounded-xl mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        @if(session('erro'))
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-4">
                {{ session('erro') }}
            </div>
        @endif

        @auth
            @if(auth()->user()->is_admin)
                <div class="text-center mb-8">
                    <a href="{{ route('movies.create') }}"
                       class="bg-blue-600 text-white font-bold px-8 py-3 rounded-full shadow-lg transition-all duration-300 transform 
                              hover:bg-blue-700 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                        ➕ Adicionar Filme
                    </a>
                </div>
            @endif
        @endauth

        @forelse($filmes as $filme)
            <div class="bg-white border border-blue-200 shadow-md rounded-xl p-6 mb-6">
                <h2 class="text-2xl font-bold text-blue-700 mb-2">{{ $filme->titulo }}</h2>

                <p class="text-gray-700 mb-2">{{ $filme->sinopse ?: 'Sinopse não disponível.' }}</p>

                <p class="text-gray-600">
                    <strong>Data de lançamento:</strong> 
                    {{ optional($filme->data_lancamento)->format('d/m/Y') ?? 'Não informado' }}
                </p>

                <p class="text-gray-600"><strong>Onde assistir:</strong> {{ $filme->onde_assistir ?? 'Não informado' }}</p>

                <p class="text-gray-600">
                    <strong>Cineastas:</strong>
                    {{ $filme->filmmakers->isNotEmpty() 
                        ? $filme->filmmakers->pluck('nome')->join(', ') 
                        : 'Não informado' }}
                </p>

                <p class="text-gray-600">
                    <strong>Atores:</strong>
                    {{ $filme->actors->isNotEmpty() 
                        ? $filme->actors->pluck('nome')->join(', ') 
                        : 'Não informado' }}
                </p>

                <p class="text-gray-600">
                    <strong>Gêneros:</strong>
                    {{ $filme->genres->isNotEmpty() 
                        ? $filme->genres->pluck('nome')->join(', ') 
                        : 'Não informado' }}
                </p>

                @auth
                    @if(auth()->user()->is_admin || auth()->id() === $filme->user_id)
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('movies.edit', $filme->id) }}" 
                               class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
                               ✏️ Editar
                            </a>

                            <form action="{{ route('movies.destroy', $filme->id) }}" method="POST" 
                                  onsubmit="return confirm('Deseja realmente deletar este filme?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-blue-600 hover:bg-blue700 text-white px-4 py-2 rounded-lg shadow">
                                    🗑️ Deletar
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth

                <h3 class="text-lg font-semibold text-blue-600 mb-2">
                    Comentários ({{ $filme->comments->count() }})
                </h3>

                @if($filme->comments->isNotEmpty())
                    @foreach($filme->comments as $comment)
                        <div class="mb-2 p-2 border-l-4 border-blue-300 bg-blue-50 rounded hover:bg-blue-100 transition">
                            <p class="text-gray-700">
                                <a href="{{ route('comments.show', $comment->id) }}" class="hover:underline">
                                    <strong>{{ $comment->autor }}:</strong> {{ Str::limit($comment->conteudo, 100) }}
                                </a>

                                @auth
                                    @if(auth()->id() === $comment->user_id)
                                        <div class="mt-1 flex gap-2">
                                            <a href="{{ route('comments.edit', $comment->id) }}" 
                                            class="text-blue-600 hover:underline">Editar</a>
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:underline"
                                                        onclick="return confirm('Tem certeza que deseja excluir este comentário?')">
                                                    Deletar
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500">Não há comentários ainda.</p>
                @endif


                <hr class="my-4 border-blue-200">

                @auth
                    <h4 class="text-blue-600 font-semibold mb-2">Adicionar comentário</h4>
                    <form action="{{ route('movies.comments.store', $filme->id) }}" 
                          method="POST" class="space-y-2">
                        @csrf
                        <textarea name="conteudo" 
                                  class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" 
                                  rows="3" required>{{ old('conteudo') }}</textarea>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                            Enviar comentário
                        </button>
                    </form>
                @else
                    <p class="text-gray-500 mt-2">Você precisa estar logado para comentar.</p>
                @endauth
            </div>
        @empty
            <p class="text-gray-500 text-center">Nenhum filme cadastrado ainda.</p>
        @endforelse

    </div>

</body>
</html>
