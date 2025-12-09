<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
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

        <h1 class="text-4xl font-extrabold text-blue-600 text-center mb-6">🎬 Editar Filme</h1>
        <hr class="border-blue-200 mb-8">

        @if(session('sucesso'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 p-4 rounded-xl mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        <div class="bg-white border border-blue-200 shadow-md rounded-xl p-8 mb-8">
            <form action="{{ route('movies.update', $filme->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold mb-2">Título:</label>
                    <input type="text" name="titulo"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo', $filme->titulo) }}">
                    @error('titulo')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Data de Lançamento:</label>
                    <input type="date" name="data_lancamento"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('data_lancamento') border-red-500 @enderror"
                        value="{{ old('data_lancamento', $filme->data_lancamento) }}">
                    @error('data_lancamento')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Onde Assistir:</label>
                    <input type="text" name="onde_assistir"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('onde_assistir') border-red-500 @enderror"
                        value="{{ old('onde_assistir', $filme->onde_assistir) }}">
                    @error('onde_assistir')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Sinopse:</label>
                    <textarea name="sinopse" rows="4"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('sinopse') border-red-500 @enderror">{{ old('sinopse', $filme->sinopse) }}</textarea>
                    @error('sinopse')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Cineastas:</label>
                    <select name="filmmaker_id[]" multiple size="5"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('filmmaker_id') border-red-500 @enderror">
                        @foreach ($filmmakers as $filmmaker)
                            <option value="{{ $filmmaker->id }}"
                                {{ collect(old('filmmaker_id', $filme->filmmakers->pluck('id')))->contains($filmmaker->id) ? 'selected' : '' }}>
                                {{ $filmmaker->nome }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-blue-500">Segure CTRL para selecionar vários.</small>
                    @error('filmmaker_id')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Atores:</label>
                    <select name="actors[]" multiple size="6"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('actors') border-red-500 @enderror">
                        @foreach ($actors as $actor)
                            <option value="{{ $actor->id }}"
                                {{ collect(old('actors', $filme->actors->pluck('id')))->contains($actor->id) ? 'selected' : '' }}>
                                {{ $actor->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-blue-500">Segure CTRL para selecionar vários atores.</small>
                    @error('actors')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Gêneros:</label>
                    <select name="genres[]" multiple size="5"
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('genres') border-red-500 @enderror">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ collect(old('genres', $filme->genres->pluck('id')))->contains($genre->id) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-blue-500">Segure CTRL para selecionar vários gêneros.</small>
                    @error('genres')
                        <p class="text-blue-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow-lg font-semibold tracking-wide">
                        Atualizar Filme
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
