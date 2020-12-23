<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\New_movies;
use App\Models\Old_movies;
use Illuminate\Http\Request;

/**
 * Class MovieHelper
 *
 * @package App\Services
 */
class MovieHelper {

    /**
     * @param $request
     *
     * @return string
     */
    public static function createMovie($request) {
        $movie = Movie::where('imdb_title_id', $request['imdb_title_id'])
            ->first();

        if (is_null($movie)) {
            $movie = new Movie;

            $request['genre'] = is_array($request['genre']) ? $request['genre'] : [$request['genre']];
            $request['country'] = is_array($request['country']) ? $request['country'] : [$request['country']];
            $request['director'] = is_array($request['director']) ? $request['director'] : [$request['director']];
            $request['writer'] = is_array($request['writer']) ? $request['writer'] : [$request['writer']];
            $request['actors'] = is_array($request['actors']) ? $request['actors'] : [$request['actors']];
            $request['language'] = is_array($request['language']) ? $request['language'] : [$request['language']];

            $movie->imdb_title_id = $request['imdb_title_id'];
            $movie->title = $request['title'];
            $movie->year = $request['year'];
            $movie->genre = implode(', ', $request['genre']);
            $movie->duration = $request['duration'];
            $movie->country = implode(', ', $request['country']);
            $movie->language = implode(', ', $request['language']);
            $movie->director = implode(', ', $request['director']);
            $movie->writer = implode(', ', $request['writer']);
            $movie->actors = implode(', ', $request['actors']);
            $movie->description = $request['description'];
            $movie->avg_vote = $request['avg_vote'];
            $movie->votes = $request['votes'];
            $movie->reviews_from_users = $request['reviews_fr_users'];
            $movie->reviews_from_critics = $request['reviews_fr_critics'];
            $movie->is_usa = $request['is_usa'];
            $movie->is_europe = $request['is_europe'];
            $movie->is_top = $request['avg_vote'] >= 8;
            $movie->is_usa = NULL !== (array_search('USA', $request['country']));
            $movie->is_europe = Helper::isEurope($request['country']);

            $movie->save();

            $movie->countries()
                ->attach((Helper::GetCountries($request['country'])));
            $movie->genres()->attach((Helper::GetGenres($request['genre'])));
            $movie->casts()
                ->attach((Helper::GetCasts($request['director'], $request['writer'], $request['actors'])));
            $movie->languages()
                ->attach((Helper::GetLanguages($request['language'])));

            if ($request['year'] >= 1980 && empty(New_movies::where('movie_id', $movie->id)
                    ->first())) {
                $newMovies = new New_movies ();
                $newMovies->movie_id = $movie->id;
                $newMovies->year = $movie->year;

                $newMovies->save();

            }
            elseif ($request['year'] < 1980 && empty(Old_movies::where('movie_id', $movie->id)
                    ->first())) {
                $oldMovies = new Old_movies();
                $oldMovies->movie_id = $movie->id;
                $oldMovies->year = $movie->year;

                $oldMovies->save();
            }

            return 'Created';
        }

        return 'Already Exist';
    }

}
