<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Movie;
use App\Models\New_movies;
use App\Models\Old_movies;
use App\Services\Helper;
use App\Services\MovieHelper;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function create(Request $request)
    {
        MovieHelper::createMovie($request);
    }
}
