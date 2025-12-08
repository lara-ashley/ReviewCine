<h1>{{ $filme->titulo }}</h1>

<p><strong>Cineasta:</strong> {{ $filme->filmmaker->nome ?? 'Não informado' }}</p>
<p><strong>Data de Lançamento:</strong> {{ $filme->data_lancamento->format('d/m/Y') }}</p>
<p><strong>Onde Assistir:</strong> {{ $filme->onde_assistir ?? 'Não informado' }}</p>
<p><strong>Sinopse:</strong> {{ $filme->sinopse ?: 'Sem sinopse disponível.' }}</p>

<hr>
<h2>Comentários ({{ $filme->comments->count() }})</h2>

@if($comentariosLimitados->isNotEmpty())
    @foreach($comentariosLimitados as $comment)
        <p>
            <strong>{{ $comment->autor }}:</strong> {{ $comment->conteudo }}

            @if(auth()->check() && $comment->autor === auth()->user()->name)
                | <a href="{{ route('comments.edit', $comment->id) }}">Editar</a>
                |
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

    @if($filme->comments->count() > $comentariosLimitados->count())
        <p><a href="{{ route('movies.comments', $filme->id) }}">Ver todos os comentários</a></p>
    @endif
@else
    <p>Não há comentários ainda.</p>
@endif

@if(auth()->check())
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $filme->id }}">

        <label>Comentário:</label><br>
        <textarea name="conteudo" cols="50" rows="5" required>{{ old('conteudo') }}</textarea><br><br>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Enviar comentário
        </button>
    </form>
@else
    <p>Você precisa estar logado para comentar.</p>
@endif
