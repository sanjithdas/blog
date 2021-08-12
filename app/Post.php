<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
class Post extends Model
{
    public function comments(){
      //  dd($jobs->toSql(), $jobs->getBindings());  
     // dd(Post::with('comments')->find(1));
        return $this->hasMany(Comment::class);
     //  dd($this->comments()->first());
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
