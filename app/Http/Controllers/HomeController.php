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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //
       // return view('dashboard');
        if (Auth::user()->admin){
            return  redirect()->route('adminDashboard');
        }
        elseif (Auth::user()->author){
            return  redirect()->route('author.dashboard');
        }
        else{
            return  redirect()->route('user.dashboard');
        }
    }
}
