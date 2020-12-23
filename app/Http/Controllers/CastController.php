<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Services\CastHelper;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function create(Request $request)
    {
        CastHelper::createCast($request);
    }
}
