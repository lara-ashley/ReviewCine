@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $filme->titulo }}</h1>
    <p>{{ $filme->sinopse }}</p>
    <p><strong>Data de lançamento:</strong> {{ $filme->data_lancamento }}</p>
    <p><strong>Onde assistir:</strong> {{ $filme->onde_assistir ?? 'Não informado' }}</p>

    <hr>
    <h2>Comentários</h2>

    @if($filme->comments->count() > 0)
        @foreach($filme->comments as $comment)
            <p>
                <strong>{{ $comment->autor }}:</strong> {{ $comment->conteudo }}

                @if(auth()->check() && $comment->autor === auth()->user()->name)
                    | <a href="{{ route('comments.edit', $comment->id) }}">Editar</a> |
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este comentário?')">
                            Deletar
                        </button>
                    </form>
                @endif
            </p>
        @endforeach
    @else
        <p>Não há comentários ainda.</p>
    @endif

    <hr>
    @auth
        <h3>Adicionar comentário</h3>
        <form action="{{ route('movies.comments.store', $filme->id) }}" method="POST">
            @csrf
            <textarea name="conteudo" cols="50" rows="5" required></textarea><br><br>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Enviar comentário
            </button>
        </form>
    @else
        <p>Você precisa estar logado para comentar.</p>
    @endauth
</div>
@endsection
