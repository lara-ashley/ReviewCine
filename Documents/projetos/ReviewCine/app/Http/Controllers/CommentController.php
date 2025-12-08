<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comentarios = Comment::latest()->get();
        return view('comments.index', compact('comentarios'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $data['autor'] = auth()->user()->name;
        $data['movie_id'] = $request->movie_id;

        Comment::create($data);

        return redirect()->back()->with('sucesso', 'Comentário criado!');
    }

    public function edit(Comment $comment)
    {
        if ($comment->autor !== auth()->user()->name) {
            abort(403, 'Não autorizado.');
        }
        return view('comments.edit', compact('comment'));
    }

    public function update(StoreCommentRequest $request, Comment $comment)
    {
        if ($comment->autor !== auth()->user()->name) {
            abort(403, 'Não autorizado.');
        }
        $comment->update($request->validated());
        return redirect()->back()->with('sucesso', 'Comentário atualizado!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->autor !== auth()->user()->name) {
            abort(403, 'Não autorizado.');
        }
        $comment->delete();
        return redirect()->back()->with('sucesso', 'Comentário deletado!');
    }
}
