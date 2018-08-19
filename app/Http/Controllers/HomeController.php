<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::guest() ){
            return redirect('/login');
        }else{

            if(Auth::user()->name == 'admin'){
                return redirect('admin/index');
            }else{
                return redirect('app/index');
            }

        }
        //return view('/home');
        //return redirect()->intended('/');
    }
}
