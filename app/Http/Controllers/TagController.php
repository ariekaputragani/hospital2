<?php

namespace App\Http\Controllers;

use App\Models\{Post, Tag};
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag) {
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
        $posts = $tag->posts()->latest()->paginate(10);
        return view('berita', compact('posts', 'tag', 'months'));
    }
    public function store(TagRequest $request) {
        $attr = $request->all();
        $slug = \Str::Slug(request('name'));
        $attr['slug'] = $slug;
        Tag::create($attr);
        return redirect()->back();
    }
}
