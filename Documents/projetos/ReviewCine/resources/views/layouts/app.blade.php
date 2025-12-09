<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReviewCine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-indigo-600 text-white px-6 py-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">🎬 ReviewCine</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <span>Olá, {{ auth()->user()->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                            Sair
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

</body>
</html>
