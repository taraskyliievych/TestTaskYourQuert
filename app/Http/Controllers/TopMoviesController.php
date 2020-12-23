<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

/**
 * Class TopMoviesController
 *
 * @package App\Http\Controllers
 */
class TopMoviesController extends Controller {

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke() {
        $topMovies = [];
        $newestYear = floor(Movie::max('year') / 10) * 10;
        $oldestYear = floor(Movie::min('year') / 10) * 10;

        for ($i = $oldestYear; $i <= $newestYear; $i = $i + 10) {
            $topMoviesInPeriod = Movie::where('votes', '>', 500)
                ->where('votes', '>', 500)
                ->where('year', '>', $i)
                ->where('year', '<', $i + 10)
                ->limit(5)
                ->orderBy('avg_vote', 'desc')
                ->get()
                ->toArray();

            $topMovies[$i . ' - ' . ($i + 10)] = $topMoviesInPeriod;
        }

        return view('topMovies', ['topMovies' => $topMovies]);
    }
}
