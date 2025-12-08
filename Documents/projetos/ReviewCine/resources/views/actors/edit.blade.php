<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <!-- Cabeçalho com CRUDs -->
    <nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-xl font-bold">🎬 ReviewCine - Editar Ator</h1>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('movies.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>

    <!-- Formulário de edição -->
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-6">

        <h1 class="text-3xl font-extrabold text-blue-600 mb-6 text-center">✏️ Editar Ator</h1>

        <!-- Mensagens de erro -->
        @if ($errors->any())
            <div class="bg-blue-100 text-blue-700 p-4 rounded mb-6">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('actors.update', $actor) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-2">Nome</label>
                <input type="text" name="name" value="{{ old('name', $actor->name) }}"
                       class="w-full border border-blue-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-2">Data de nascimento</label>
                <input type="date" name="birthdate" value="{{ old('birthdate', $actor->birthdate) }}"
                       class="w-full border border-blue-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-2">Biografia</label>
                <textarea name="bio" rows="5"
                          class="w-full border border-blue-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('bio', $actor->bio) }}</textarea>
            </div>

            <div class="flex justify-between gap-4">
                <a href="{{ route('actors.index') }}"
                   class="w-1/2 text-center bg-gray-200 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-300 transition">
                   Cancelar
                </a>

                <button type="submit"
                        class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-3 rounded-lg shadow transition-colors duration-200">
                    Atualizar Ator
                </button>
            </div>
        </form>
    </div>

</body>
</html>
