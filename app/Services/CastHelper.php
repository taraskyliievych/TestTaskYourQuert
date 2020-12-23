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

            $request['name'] = is_array($request['name']) ? $request['name'] : [$request['name']];
            $request['place_of_birth'] = is_array($request['place_of_birth']) ? $request['place_of_birth'] : [$request['place_of_birth']];

            $cast->imdb_name_id = $request['imdb_name_id'];
            $cast->name = $request['name'];
            $cast->height = $request['height'];
            $cast->bio = $request['bio'];
            $cast->date_of_birth = $request['date_of_birth'];
            $cast->place_of_birth = $request['place_of_birth'];
            $cast->children = $request['children'];
            $cast->is_usa = NULL !== (array_search('USA', $request['place_of_birth']));
            $cast->is_europe = Helper::isEurope($request['place_of_birth']);

            return 'Created';
        }

        return 'Already Exist';
    }
}
