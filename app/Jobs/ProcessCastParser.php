<?php

namespace App\Jobs;

use App\Services\CastHelper;
use Illuminate\Bus\Queueable;
use App\Models\Parser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;

/**
 * Class ProcessCastParser
 *
 * @package App\Jobs
 */
class ProcessCastParser implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $fileName;

    /**
     * Create a new job instance.
     *
     * @return void
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
        ini_set('max_execution_time', 0);
        $reader = Reader::createFromPath(public_path('temporaryCSV/') . $this->fileName, 'r');

        foreach ($reader as $index => $row) {
            if ($index > 0) {
                if ($row[0] == 'imdb_title_id') {
                    return $row[20];
                }
                $item = [
                    'imdb_name_id' => $row[0],
                    'name' => $row[1],
                    'height' => $row[3],
                    'bio' => $row[4],
                    'date_of_birth' => $row[6],
                    'place_of_birth' => $row[7],
                    'children' => $row[16],
                ];

                CastHelper::createCast($item);
            }
        }

        $time_end = microtime(TRUE);

        $parser = new Parser;

        $parser->items_in_file = $index;
        $parser->changes_in_casts = 0;
        $parser->changes_in_countries = 0;
        $parser->changes_in_genres = 0;
        $parser->changes_in_languages = 0;
        $parser->changes_in_movies = 0;
        $parser->changes_in_new_movies = 0;
        $parser->changes_in_old_movies = 0;
        $parser->parse_time = ($time_end - $time_start);

        $parser->save();

        unlink(public_path('temporaryCSV/') . $this->fileName);
    }
}
