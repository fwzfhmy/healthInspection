<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clientHome()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $appointment = Appointment::where('clientId', Auth::user()->id)
            ->whereNotIn('status', [0, 4])
            ->first();
        return view('home', ["message" => "I am client role"])->with(['appointment' => $appointment, 'user' => $user]);
    }
    public function counselorHome()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $appointment = Appointment::where('counselorId', Auth::user()->id)
            ->whereNotIn('status', [0, 4])
            ->first();
        return view('counselor.home', ["message" => "I am counselor role"])->with(['appointment' => $appointment, 'user' => $user]);
    }
    public function adminHome()
    {
        return view('admin.home', ["message" => "I am admin role"]);
    }
}
