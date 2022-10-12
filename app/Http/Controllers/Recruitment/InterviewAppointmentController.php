<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InterviewAppointmentController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['permission: recruitment.prospects.index|recruitment.prospects.create|recruitment.prospects.update']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('recruitment.interview.app');
    }
    public function create()
    {
        return view('recruitment.interview.register');
    }
}
