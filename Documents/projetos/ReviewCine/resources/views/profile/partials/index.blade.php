<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-6">

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-extrabold text-blue-600 text-center mb-6">Meu Perfil</h1>

    <!-- Informações do usuário -->
    <div class="space-y-4 mb-8">
        <p><span class="font-semibold text-blue-900">Nome:</span> {{ auth()->user()->name }}</p>
        <p><span class="font-semibold text-blue-900">E-mail:</span> {{ auth()->user()->email }}</p>
        <p><span class="font-semibold text-blue-900">Conta criada em:</span> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
    </div>

    <!-- Botões de ação -->
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <!-- Editar perfil -->
        <a href="{{ route('profile.edit') }}"
           class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center transition-colors duration-200">
            Editar Perfil
        </a>

        <!-- Deletar conta -->
        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');" class="w-full md:w-auto">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full md:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                Excluir Conta
            </button>
        </form>
    </div>

    <!-- Resumo de filmes adicionados pelo usuário -->
    <div>
        <h2 class="text-2xl font-bold text-blue-600 mb-4">Meus Filmes</h2>

        @if(auth()->user()->movies->isNotEmpty())
            <ul class="space-y-4">
                @foreach(auth()->user()->movies as $movie)
                    <li class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm hover:bg-blue-100 transition">
                        <h3 class="font-semibold text-blue-900">{{ $movie->titulo }}</h3>
                        <p class="text-gray-700">{{ $movie->sinopse ?: 'Sinopse não disponível.' }}</p>
                        <p class="text-gray-600"><strong>Data de lançamento:</strong> {{ $movie->data_lancamento->format('d/m/Y') }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Você ainda não adicionou nenhum filme.</p>
        @endif
    </div>

</div>

</body>
</html>
