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

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_movie');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    public function casts()
    {
        return $this->belongsToMany(Cast::class, 'cast_movie');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_movie');
    }
}
