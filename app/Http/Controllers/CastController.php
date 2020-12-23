<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCastParser;
use Illuminate\Http\Request;

/**
 * Class CastController
 *
 * @package App\Http\Controllers
 */
class CastController extends Controller {

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function create(Request $request) {
        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('temporaryCSV'), $fileName);

        ProcessCastParser::dispatch($fileName);

        echo 'ProcessCastParser job Created';
    }
}
