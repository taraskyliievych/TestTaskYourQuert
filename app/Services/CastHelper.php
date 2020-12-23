<?php

namespace App\Services;

use App\Models\Cast;

/**
 * Class CastHelper
 *
 * @package App\Services
 */
class CastHelper {

    /**
     * @param $request
     *
     * @return string
     */
    public static function createCast($request) {
        $cast = Cast::where('imdb_name_id', $request['imdb_name_id'])->first();

        if (is_null($cast)) {
            $cast = new Cast;

            $request['genre'] = is_array($request['genre']) ? $request['genre'] : [$request['genre']];
            $request['country'] = is_array($request['country']) ? $request['country'] : [$request['country']];
            $request['director'] = is_array($request['director']) ? $request['director'] : [$request['director']];
            $request['writer'] = is_array($request['writer']) ? $request['writer'] : [$request['writer']];
            $request['actors'] = is_array($request['actors']) ? $request['actors'] : [$request['actors']];

            $cast->imdb_title_id = $request['imdb_title_id'];
            $cast->name = $request['name'];
            $cast->height = $request['height'];
            $cast->bio = $request['bio'];
            $cast->date_of_birth = $request['date_of_birth'];
            $cast->place_of_birth = $request['place_of_birth'];
            $cast->children = $request['children'];
            $cast->is_usa = NULL !== (array_search('USA', $request['country']));
            $cast->is_europe = Helper::isEurope($request['country']);

            return 'Created';
        }

        return 'Already Exist';
    }
}
