<h1>Comentários de {{ $filme->titulo }}</h1>

@if($comentarios->count() > 0)
    @foreach($comentarios as $comment)
        <p>
            <strong>{{ $comment->autor }}:</strong> {{ $comment->conteudo }}

            @if(auth()->check() && $comment->autor === auth()->user()->name)
                | <a href="{{ route('comments.edit', $comment->id) }}">Editar</a> |
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este comentário?')">Deletar</button>
                </form>
            @endif
        </p>
    @endforeach
@else
    <p>Não há comentários ainda.</p>
@endif

<p><a href="{{ route('movies.show', $filme->id) }}">Voltar para o filme</a></p>
