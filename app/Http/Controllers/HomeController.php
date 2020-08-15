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
    // public function index()
    // {
    //     return view('/posts');
    // }

    public function index()
    {
        return view('home');
        if (Auth::user()->id) {
            return redirect()->route('posts.index');
        } else {
            return view('home');
        }
    }
}
