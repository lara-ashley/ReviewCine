<?php

namespace App\Http\Controllers;

use App\Models\Filmmaker;
use App\Http\Requests\StoreFilmmakerRequest;
use Illuminate\Http\Request;

class FilmmakerController extends Controller
{
    public function index()
    {
        $filmmakers = Filmmaker::all();
        return view('filmmakers.index', compact('filmmakers'));
    }

    public function create()
    {
        return view('filmmakers.create');
    }

    public function store(StoreFilmmakerRequest $request)
    {
        Filmmaker::create($request->validated());
        return redirect()->route('filmmakers.index')->with('sucesso', 'Filmmaker criado com sucesso!');
    }

    public function edit($id)
    {
        $filmmaker = Filmmaker::findOrFail($id);
        return view('filmmakers.edit', compact('filmmaker'));
    }

    public function update(StoreFilmmakerRequest $request, $id)
    {
        $filmmaker = Filmmaker::findOrFail($id);
        $filmmaker->update($request->validated());
        return redirect()->route('filmmakers.index')->with('sucesso', 'Filmmaker atualizado!');
    }

    

    public function destroy($id)
    {
        $filmmaker = Filmmaker::findOrFail($id);
        $filmmaker->delete();
        return redirect()->route('filmmakers.index')->with('sucesso', 'Filmmaker deletado!');
    }
}