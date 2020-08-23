<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataLayer;
use Illuminate\Support\Facades\Auth;

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
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $groups = $dl->getGroupsOfUser($userID);

        return view('home')->with('userID', $userID)->with('groups', $groups);
    }
}
