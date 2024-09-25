<?php

namespace App\Http\Controllers;

use App\Models\{Post, User};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user) {
        $months=array();
        for ($y = 2014; $y <=2038; $y++)
        {
            for($m = 1; $m <= 12; $m++){
                if($m < 10) $mon = Post::where("created_at","like","$y-0$m%")->count();
                else $mon = Post::where("created_at","like","$y-$m%")->count();
                if($mon > 0) {
                    if($m < 10) array_push($months, "$y-0$m");
                    else array_push($months, "$y-$m");
                }
            }
        }
        $months = array_reverse($months);
        $posts = $user->posts()->latest()->paginate(10);
        return view('berita', compact('posts', 'user', 'months'));
    }
    public function update(User $user) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $attr = $request->all();
        $user->update($attr);
        return redirect()->back();
    }
}
