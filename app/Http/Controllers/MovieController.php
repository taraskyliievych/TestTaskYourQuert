<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessMovieParser;
use Illuminate\Http\Request;

/**
 * Class MovieController
 *
 * @package App\Http\Controllers
 */
class MovieController extends Controller {

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function create(Request $request) {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('temporaryCSV'), $fileName);

        $this->dispatch(new ProcessMovieParser($fileName));

        return 'ProcessMovieParser job Created';
    }
}
