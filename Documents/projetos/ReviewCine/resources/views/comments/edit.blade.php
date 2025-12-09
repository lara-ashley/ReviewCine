<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Comentário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
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

    <div class="flex justify-center px-6">
        <div class="w-full max-w-3xl bg-white border border-blue-200 shadow-md rounded-xl p-8">
            <h1 class="text-3xl font-extrabold text-blue-600 mb-6 text-center">✏️ Editar Comentário</h1>

            @if(session('sucesso'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 p-4 rounded-xl mb-6">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <input type="hidden" name="movie_id" value="{{ $comment->movie_id }}">
                <input type="hidden" name="autor" value="{{ $comment->autor }}">

                <div>
                    <label class="block font-semibold mb-2">Comentário:</label>
                    <textarea name="conteudo" rows="5"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('conteudo') border-red-500 @enderror"
                        required>{{ old('conteudo', $comment->conteudo) }}</textarea>
                    @error('conteudo')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow-lg font-semibold tracking-wide">
                        Atualizar Comentário
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">⬅ Voltar</a>
            </div>
        </div>
    </div>

</body>
</html>
