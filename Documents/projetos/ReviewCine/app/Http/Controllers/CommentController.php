<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(Movie $movie)
    {
        $comentarios = $movie->comments()->latest()->get();
        return view('comments.index', compact('comentarios', 'movie'));
    }


    public function store(StoreCommentRequest $request, Movie $movie)
    {
        $data = $request->validated();
        $data['autor'] = auth()->user()->name;
        $data['user_id'] = auth()->id();
        $data['movie_id'] = $movie->id;

        Comment::create($data);

        return redirect()->back()->with('sucesso', 'Comentário criado!');
    }

    public function edit(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Não autorizado.');
        }

        return view('comments.edit', compact('comment'));
    }


    public function update(StoreCommentRequest $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Não autorizado.');
        }

        $comment->update($request->validated());

        return redirect()->back()->with('sucesso', 'Comentário atualizado!');
    }

    public function show(Comment $comment)
    {
        $comment->load('movie');

        return view('comments.show', compact('comment'));
    }


    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Não autorizado.');
        }

        $comment->delete();

        return redirect()->back()->with('sucesso', 'Comentário deletado!');
    }
}
