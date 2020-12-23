<?php

namespace App\Jobs;

use App\Models\Cast;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use App\Models\New_movies;
use App\Models\Old_movies;
use App\Models\Parser;
use App\Services\MovieHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;

/**
 * Class ProcessMovieParser
 *
 * @package App\Jobs
 */
class ProcessMovieParser implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileName;

    /**
     * Create a new job instance.
     *
     * @param $fileName
     */
    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @param $fileName
     *
     * @return void
     */
    public function handle() {
        $time_start = microtime(TRUE);

        $latestIds = [
            'changes_in_casts' => empty($castLast = Cast::latest()
                ->first()) ? 0 : $castLast->id,
            'changes_in_countries' => empty($countryLast = Country::latest()
                ->first()) ? 0 : $countryLast->id,
            'changes_in_genres' => empty($genreLast = Genre::latest()
                ->first()) ? 0 : $genreLast->id,
            'changes_in_languages' => empty($languageLast = Language::latest()
                ->first()) ? 0 : $languageLast->id,
            'changes_in_movies' => empty($movieLast = Movie::latest()
                ->first()) ? 0 : $movieLast->id,
            'changes_in_new_movies' => empty($newMoviesLast = New_movies::latest()
                ->first()) ? 0 : $newMoviesLast->id,
            'changes_in_old_movies' => empty($oldMovies = Old_movies::latest()
                ->first()) ? 0 : $oldMovies->id,
        ];

        ini_set('max_execution_time', 0);
        $reader = Reader::createFromPath(public_path('temporaryCSV/') . $this->fileName, 'r');

        foreach ($reader as $index => $row) {
            if ($index > 0) {
                if ($row[0] == 'imdb_title_id') {
                    return $row[20];
                }
                $item = [
                    'imdb_title_id' => $row[0],
                    'title' => $row[1],
                    'year' => $row[3],
                    'genre' => explode(', ', $row[5]),
                    'duration' => $row[6],
                    'country' => explode(', ', $row[7]),
                    'language' => explode(', ', $row[8]),
                    'director' => explode(', ', $row[9]),
                    'writer' => explode(', ', $row[10]),
                    'actors' => explode(', ', $row[12]),
                    'description' => $row[13],
                    'avg_vote' => is_string($row[14]) ? (int) $row[14] : $row[14],
                    'votes' => is_string($row[15]) ? (int) $row[15] : $row[15],
                    'reviews_from_users' => is_string($row[20]) ? (int) $row[20] : $row[20],
                    'reviews_from_critics' => is_string($row[21]) ? (int) $row[21] : $row[21],
                ];

                MovieHelper::createMovie($item);
            }
        }

        $time_end = microtime(TRUE);

        $parser = new Parser;

        sleep(1);

        $parser->items_in_file = $index;
        $parser->changes_in_casts = Cast::latest()
                ->first()->id - $latestIds['changes_in_casts'];
        $parser->changes_in_countries = Country::latest()
                ->first()->id - $latestIds['changes_in_countries'];
        $parser->changes_in_genres = Genre::latest()
                ->first()->id - $latestIds['changes_in_genres'];
        $parser->changes_in_languages = Language::latest()
                ->first()->id - $latestIds['changes_in_languages'];
        $parser->changes_in_movies = Movie::latest()
                ->first()->id - $latestIds['changes_in_movies'];
        $parser->changes_in_new_movies = New_movies::latest()
                ->first()->id - $latestIds['changes_in_new_movies'];
        $parser->changes_in_old_movies = Old_movies::latest()
                ->first()->id - $latestIds['changes_in_old_movies'];
        $parser->parse_time = ($time_end - $time_start);

        $parser->save();

        unlink(public_path('temporaryCSV/') . $this->fileName);
    }
}
