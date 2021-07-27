<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
    Username supeadmin
    Password: 11111111
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
      
        
       //print_r("hello");

        // return redirect(route('admin.index'));
       // return "Hello";
    }

     public function logout()
    {
        Auth::logout();
        return redirect(route('admin.index'));
    }

     public function home()
    {

       // return redirect(route('home'));
        return view('auth.home');
        // return "Hello";
    }

}
