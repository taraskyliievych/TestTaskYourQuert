<?php

namespace App\Services;

use App\Models\Cast;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use SameerShelavale\PhpCountriesArray\CountriesArray;

/**
 * Class CountryHelper
 *
 * @package App\Services
 */
class Helper {

    /**
     * Search countries, if not exist create. Check is_usa and is_europe.
     *
     * @param $countriesNames
     *
     * @return array
     */
    public static function GetCountries($countriesNames) {
        $countriesIds = [];

        foreach ($countriesNames as $countryName) {
            $country = Country::where('name', $countryName)->first();

            if (empty($country)) {
                $countriesList = CountriesArray::get('name', 'continent');
                $country = new Country;
                $country->name = $countryName;

                if ($countryName === 'USA') {
                    $country->is_usa = TRUE;
                }
                else {
                    $country->is_usa = FALSE;
                }

                if (!empty($countriesList[$countryName]) && $countriesList[$countryName] === 'Europe') {
                    $country->is_europe = TRUE;
                }
                else {
                    $country->is_europe = FALSE;
                }

                $country->save();
            }

            $countriesIds[] = $country->id;
        }

        return Country::find($countriesIds);
    }

    /**
     * @param $genresNames
     *
     * @return mixed
     */
    public static function GetGenres($genresNames) {
        $genresIds = [];

        foreach ($genresNames as $genreName) {
            $genre = Genre::where('name', $genreName)->first();

            if (empty($genre)) {

                $genre = new Genre();

                $genre->name = $genreName;

                $genre->save();
            }

            $genresIds[] = $genre->id;
        }

        return Genre::find($genresIds);
    }

    /**
     * @param $directorsNames
     * @param $writersNames
     * @param $actorsNames
     *
     * @return mixed
     */
    public static function GetCasts($directorsNames, $writersNames, $actorsNames) {
        $castIds = [];
        $castsNames = array_merge($directorsNames, $writersNames, $actorsNames);

        foreach ($castsNames as $castName) {
            $cast = Cast::where('name', $castName)->first();

            if (empty($cast)) {
                $cast = new Cast();

                $cast->name = $castName;

                $cast->save();
            }

            $castIds[] = $cast->id;
        }

        return Cast::find($castIds);
    }

    /**
     * @param array $languagesNames
     *
     * @return mixed
     */
    public static function GetLanguages(array $languagesNames) {
        $languagesIds = [];

        foreach ($languagesNames as $languageName) {
            $language = Language::where('name', $languageName)->first();

            if (empty($language)) {

                $language = new Language();

                $language->name = $languageName;

                $language->save();
            }

            $languagesIds[] = $language->id;
        }

        return Language::find($languagesIds);
    }

    /**
     * @param $countriesNames
     *
     * @return bool
     */
    public static function isEurope($countriesNames) {
        $countriesList = CountriesArray::get('name', 'continent');

        foreach ($countriesNames as $countryName) {
            if (!empty($countriesList[$countryName]) && $countriesList[$countryName] === 'Europe') {
                return TRUE;
            }
        }

        return FALSE;
    }
}
