<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre_id'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
