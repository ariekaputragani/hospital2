<?php

namespace App\Http\Controllers;


use App\Models\{Doctor, Post, Appointment};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors = Doctor::latest()->limit(3)->get();
        $posts = Post::latest()->limit(3)->get();
        $appointment = new Appointment();
        return view('home', compact('posts','doctors','appointment'));
    }
}
