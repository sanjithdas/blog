<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class PublicController extends Controller
{
    //
    public function __construct() {
     //   $this->middleware('auth');
    }
    public function index(){
        $posts = Post::paginate(2);
        return view('welcome',compact('posts'));
    }
    public function show(Post $post){
        return view('show')->with('posts',$post);
      //  $post = Post::findOrFail($id);
    }
    public function about(){
        return view('about');
    }
    public function contact(){
        return view('contact');
    }
    public function showAllPost(){
        
    }
}
