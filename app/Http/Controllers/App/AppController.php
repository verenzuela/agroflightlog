<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{

	public static function index()
    {

		return view('app.index', []);

    }


    public static function profile()
    {

		return view('app.profile', []);

    }


}
