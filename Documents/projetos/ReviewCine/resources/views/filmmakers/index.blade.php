<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmmakers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <nav class="bg-indigo-600 text-white px-6 py-4 rounded-xl shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-xl font-bold">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-indigo-100">
                    🎬 ReviewCine
                </a>
            </h1>      
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('movies.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

        <h1 class="text-3xl font-extrabold text-blue-600 mb-6 text-center">🎬 Cineastas</h1>

        <div class="mb-6 text-center">
            <a href="{{ route('filmmakers.create') }}"
               class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                ➕ Adicionar Cineasta
            </a>
        </div>

        @if(session('sucesso'))
            <p class="bg-blue-100 text-blue-700 p-3 rounded mb-4 text-center">
                {{ session('sucesso') }}
            </p>
        @endif

        @if($filmmakers->isEmpty())
            <p class="text-gray-500 text-center">Nenhum cineasta cadastrado ainda.</p>
        @else
            <ul class="space-y-4">
                @foreach($filmmakers as $f)
                    <li class="flex items-center justify-between bg-blue-50 p-4 rounded-lg shadow-sm hover:bg-blue-100 transition">
                        <span>
                            <strong class="font-semibold text-blue-900">{{ $f->nome }}</strong> - <span class="text-blue-800">{{ $f->funcao }}</span>
                        </span>

                        <div class="flex gap-2">
                            <a href="{{ route('filmmakers.edit', $f->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                Editar
                            </a>

                            <form action="{{ route('filmmakers.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-blue-400 text-white px-3 py-1 rounded hover:bg-blue-500 transition">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>

</body>
</html>
