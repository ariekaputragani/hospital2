<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','slug','body','category_id','user_id','thumbnail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getTakeImageAttribute() {
        return "/storage/" . $this->thumbnail;
    }
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
