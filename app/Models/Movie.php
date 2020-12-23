<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'updated_at',
        'imdb_title_id',
        'title',
        'year',
        'genre',
        'duration',
        'country',
        'language',
        'director',
        'writer',
        'actors',
        'description',
        'avg_vote',
        'votes',
        'reviews_from_users',
        'reviews_from_critics',
        'is_usa',
        'is_europe',
        'is_top'
    ];
}
