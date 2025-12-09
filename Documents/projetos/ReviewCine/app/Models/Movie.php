<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Filmmaker;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\User; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // Relacionamento com filmmakers (muitos para muitos)
    public function filmmakers()
    {
        return $this->belongsToMany(Filmmaker::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

