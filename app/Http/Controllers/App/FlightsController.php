<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightsController extends Controller
{

    public static function list()
    {

		return view('app.flights.list', []);

    }

    public static function new()
    {

		return view('app.flights.new', []);

    }

}
