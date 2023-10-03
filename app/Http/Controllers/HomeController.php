<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

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
        $team = Team::where('user_id', auth()->user()->id)->first();
        return view('home', compact('team'));
    }
}
