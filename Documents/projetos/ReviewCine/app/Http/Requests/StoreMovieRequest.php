<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'data_lancamento' => 'required|date',
            'onde_assistir' => 'nullable|string|max:255',
            'sinopse' => 'nullable|string',    
        
            'filmmaker_id' => 'required|exists:filmmakers,id',

            'actors' => 'array',
            'actors.*' => 'exists:actors,id',

            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O título do filme é obrigatório.',
            'data_lancamento.required' => 'A data de lançamento é obrigatória.',
            'filmmaker_id.required' => 'Selecione pelo menos um cineasta.',
        ];
    }
}
