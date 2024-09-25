<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\{Post, Category, Tag, User};
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $title = 'Hapus post';
        $text = 'Apakah Anda ingin menghapus post?';
        confirmDelete($title, $text);
        return view('posts.index', ['posts'=>Post::latest()->paginate(10)]);
    }
    public function berita() {
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
        return view('berita', [
            'posts'=>Post::latest()->paginate(10),
            'months'=>array_reverse($months)
        ]);
    }
    public function show(Post $post) {
        $posts_2 = Post::where('id','<>',$post->id)->where('category_id',$post->category_id)->latest()->limit(2)->get();
        $posts_3 = Post::where('id','<>',$post->id)->where('category_id',$post->category_id)->latest()->limit(3)->get();
        $posts = Post::where('id','<>',$post->id)->latest()->limit(5)->get();
        return view('posts.show', compact('post','posts','posts_2','posts_3'));
    }
    public function tag(Post $post) {
        return view('tag-input', [
            'post'=> $post,
            'tags' => Tag::get(),
        ]);
    }
    public function create() {
        return view('posts.create', [
            'post'=> new Post(),
            'users' => User::get(),
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }
    public function store(PostRequest $request) {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg'
        ]);
        $attr = $request->all();
        $slug = \Str::Slug(request('title'));
        $attr['slug'] = $slug;
        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("images/posts") : null;
        
        $attr['user_id'] = request('user');
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;
        $post = Post::create($attr);
        $post->tags()->attach(request('tags'));
        session()->flash('success', 'Post berhasil dibuat!');
        return redirect('posts');
    }
    public function edit(Post $post) {
        return view('posts.edit', [
            'post'=> $post,
            'users' => User::get(),
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }
    public function update(PostRequest $request, Post $post) {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg'
        ]);
        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/posts');
        } else {
            $thumbnail = $post->thumbnail;
        }
        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;
        $post->update($attr);
        $post->tags()->sync(request('tags'));
        session()->flash('success', 'Post berhasil diupdate!');
        return redirect('posts');
    }
    public function destroy(Post $post) {
        $post->tags()->detach();
        \Storage::delete($post->thumbnail);
        $post->delete();
        session()->flash('success', 'Post berhasil dihapus!');
        return redirect('posts');
    }
}
