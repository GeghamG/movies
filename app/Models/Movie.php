<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'imdb_id',
        'type'
    ];

    public function poster()
    {
        return $this->hasOne(Poster::class);
    }
}
