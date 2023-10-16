<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
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
         if (auth()->user()->hasRole('Admin')) {
        return view('admin.dashboard');
    } else {
        return view('admin.user_dashboard');
        }
    }
}