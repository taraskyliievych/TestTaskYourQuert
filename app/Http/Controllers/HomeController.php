<?php

namespace App\Http\Controllers;

use App\Models\Parser;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller {

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke() {
        $parse = Parser::all()->toArray();

        return view('welcome', ['parse' => $parse]);
    }
}
