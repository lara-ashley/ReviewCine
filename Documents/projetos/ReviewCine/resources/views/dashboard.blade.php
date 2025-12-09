<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
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
                <a href="{{ route('movies.index') }}" class="bg-indigo-500 px-4 py-2 rounded-lg transition hover:bg-indigo-800">Filmes</a>
                <a href="{{ route('actors.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Atores</a>
                <a href="{{ route('filmmakers.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Cineastas</a>
                <a href="{{ route('genres.index') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Gêneros</a>
                <a href="{{ route('profile.edit') }}" class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 px-4">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Bem-vindo(a), {{ auth()->user()->name }} 
        </h2>

        @if(session('erro'))
            <div class="bg-red-600 text-white p-3 rounded mb-4">
                {{ session('erro') }}
            </div>
        @endif


        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-10">

            <a href="{{ route('movies.index') }}"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">📽 Filmes</h3>
                <p class="text-gray-600">Veja todos os filmes cadastrados ou adicione novos.</p>
            </a>

            <a href="{{ route('filmmakers.index') }}"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">🎬 Cineastas</h3>
                <p class="text-gray-600">Gerencie diretores e produtores de filmes.</p>
            </a>

            <a href="{{ route('actors.index') }}"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">🧑‍🎭 Atores</h3>
                <p class="text-gray-600">Gerencie atores e consulte suas informações.</p>
            </a>

            <a href="{{ route('genres.index') }}"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">🏷️ Gêneros</h3>
                <p class="text-gray-600">Gerencie os gêneros de filmes disponíveis.</p>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">👤 Perfil</h3>
                <p class="text-gray-600">Edite suas informações pessoais e configurações.</p>
            </a>

        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-4">Filmes Cadastrados</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                    <h4 class="text-lg font-semibold text-indigo-600 mb-2">{{ $movie->titulo }}</h4>
                    <p class="text-gray-600 mb-2">Lançamento: {{ $movie->data_lancamento }}</p>
                    <p class="text-gray-600 mb-2">Onde assistir: {{ $movie->onde_assistir }}</p>
                    <p class="text-gray-600">{{ Str::limit($movie->sinopse, 80) }}</p>
                    <a href="{{ route('movies.show', $movie->id) }}" 
                       class="inline-block mt-3 text-indigo-500 hover:underline">
                        Ver detalhes
                    </a>
                </div>
            @endforeach
        </div>

    </div>

</body>
</html>
