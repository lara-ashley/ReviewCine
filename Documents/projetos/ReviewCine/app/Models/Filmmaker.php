<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filmmaker extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'nacionalidade', 'data_nascimento'];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}

