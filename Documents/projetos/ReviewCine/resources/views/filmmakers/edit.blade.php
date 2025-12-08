<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cineasta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-xl font-bold">🎬 ReviewCine - Editar Cineasta</h1>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('movies.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>

    <div class="w-full max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-lg">

        <h1 class="text-3xl font-extrabold text-blue-600 mb-6 text-center">
            ✏️ Editar Cineasta
        </h1>

        @if ($errors->any())
            <div class="bg-blue-100 border border-blue-400 text-blue-700 p-4 rounded-xl mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('filmmakers.update', $filmmaker->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col space-y-2">
                <label class="font-semibold text-gray-700">Nome</label>
                <input type="text" name="nome" value="{{ old('nome', $filmmaker->nome) }}" placeholder="Digite o nome"
                       class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
            </div>

            <div class="flex flex-col space-y-2">
                <label class="font-semibold text-gray-700">Função</label>
                <input type="text" name="funcao" value="{{ old('funcao', $filmmaker->funcao) }}" placeholder="Digite a função"
                       class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-4">
                <a href="{{ route('filmmakers.index') }}"
                   class="flex-1 text-center bg-gray-200 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-300 transition font-semibold">
                   Cancelar
                </a>

                <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-3 rounded-lg shadow-lg transition-colors duration-200">
                    Atualizar Cineasta
                </button>
            </div>
        </form>
    </div>

</body>
</html>
