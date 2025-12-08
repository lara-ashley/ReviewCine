@extends('layouts.app')

@section('content')
<h1>Editar Comentário</h1>

<form action="{{ route('comments.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="movie_id" value="{{ $comment->movie_id }}">
    <input type="hidden" name="autor" value="{{ $comment->autor }}">

    <label>Comentário:</label><br>
    <textarea name="conteudo" cols="50" rows="5" required>{{ $comment->conteudo }}</textarea><br><br>

    <button type="submit">Atualizar comentário</button>
</form>

<a href="{{ url()->previous() }}">Voltar</a>
@endsection
