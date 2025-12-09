<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Filmmaker;
use App\Models\Actor;
use App\Models\Genre;
use App\Http\Requests\StoreMovieRequest;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $filmes = Movie::with(['filmmakers', 'actors', 'genres', 'comments'])->get();
        return view('movies.index', compact('filmes'));
    }

    public function show($id)
    {
        $movie = Movie::with(['comments.user', 'filmmakers', 'actors', 'genres'])->findOrFail($id);
        return view('movies.show', compact('movie'));
    }



    public function create()
    {
        $filmmakers = Filmmaker::all();
        $actors = Actor::all();
        $genres = Genre::all();
        return view('movies.create', compact('filmmakers', 'actors', 'genres'));
    }

    public function store(StoreMovieRequest $request)
    {
        $filme = Movie::create([
            'titulo' => $request->titulo,
            'data_lancamento' => $request->data_lancamento,
            'onde_assistir' => $request->onde_assistir,
            'sinopse' => $request->sinopse,
        ]);

        if ($request->has('filmmaker_id')) {
            $filme->filmmakers()->sync($request->filmmaker_id);
        }

        if ($request->has('actors')) {
            $filme->actors()->sync($request->actors);
        }

        if ($request->has('genres')) {
            $filme->genres()->sync($request->genres);
        }

        return redirect()->route('movies.index')
            ->with('sucesso', 'Filme cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $filme = Movie::findOrFail($id);
        $filmmakers = Filmmaker::all();
        $actors = Actor::all();
        $genres = Genre::all();

        return view('movies.edit', compact('filme', 'filmmakers', 'actors', 'genres'));
    }

    public function update(StoreMovieRequest $request, $id)
    {
        $filme = Movie::findOrFail($id);

        $filme->update($request->validated());

        $filme->filmmakers()->sync($request->filmmaker_id ?? []);
        $filme->actors()->sync($request->actors ?? []);
        $filme->genres()->sync($request->genres ?? []);

        return redirect()->route('movies.index')
            ->with('sucesso', 'Filme atualizado!');
    }

    public function destroy($id)
    {
        $filme = Movie::findOrFail($id);

        $filme->filmmakers()->detach();
        $filme->actors()->detach();
        $filme->genres()->detach();
        $filme->delete();

        return redirect()->route('movies.index')
            ->with('sucesso', 'Filme deletado!');
    }
}
