<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
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
            <a href="{{ route('profile.edit') }}" class="bg-indigo-700 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Perfil</a>
        </div>
    </div>
</nav>
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-extrabold text-blue-600 mb-6 text-center">Editar Perfil</h1>

    @if(session('status') === 'profile-updated')
        <p class="bg-green-100 text-green-800 p-3 rounded mb-6 text-center">
            Perfil atualizado com sucesso!
        </p>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="block font-semibold mb-2">Nome</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border border-blue-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            @error('name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border border-blue-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            @error('email') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow">
            Atualizar Perfil
        </button>
    </form>

    <hr class="my-8 border-blue-200">

    <h2 class="text-2xl font-bold text-blue-600 mb-4">Meus Filmes</h2>

    @forelse(optional(auth()->user())->movies ?? [] as $movie)
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm mb-4 hover:bg-blue-100 transition">
            <h3 class="font-semibold text-blue-900">{{ $movie->titulo }}</h3>
            <p class="text-gray-700">{{ $movie->sinopse ?: 'Sinopse não disponível.' }}</p>
            <p class="text-gray-600"><strong>Data de lançamento:</strong> {{ $movie->data_lancamento->format('d/m/Y') }}</p>
        </div>
    @empty
        <p class="text-gray-500">Você ainda não adicionou nenhum filme.</p>
    @endforelse

    <hr class="my-8 border-blue-200">

    <h2 class="text-xl font-semibold text-red-600 mb-4">Deletar Conta</h2>
    <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-4">
        @csrf
        @method('DELETE')

        <div>
            <label class="block font-semibold mb-2">Confirme sua senha</label>
            <input type="password" name="password"
                   class="w-full border border-red-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400">
            @error('password') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow"
                onclick="return confirm('Tem certeza que deseja deletar sua conta? Esta ação não pode ser desfeita.')">
            Deletar Conta
        </button>
    </form>

</div>

</body>
</html>
