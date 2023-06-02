<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\User;
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
        $user = Auth::user();
        $userCount = User::count();
        $healthReportCount = Inspection::count();
        if ($user->role == "Admin") {
            return view('dashboard', compact('userCount', 'healthReportCount'));
        }
        return view('home');

    }
}
