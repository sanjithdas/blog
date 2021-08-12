<?php

namespace App\Http\Controllers;
use App\Charts\DashboardChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use App\Http\Requests\CreatePost;

class AuthorController extends Controller
{
    public function __construct(){
      //  $this->middleware('checkRole:author');
        $this->middleware('auth');
    }
    public function dashboard(){
        $posts =  Post::where('user_id',Auth::id())->pluck('id')->toArray();
        
        $comments = Comment::whereIn('post_id',$posts)->get();
        $todaysComments = $comments->where('created_at','>=',\Carbon\Carbon::today())->count();
        $chart = new DashboardChart;
        // Startdate is 30 days ago and the end date is today..
        $days = $this->generateDateRange(Carbon::now()->subDays(30),Carbon::now());
        $posts = [];
        $i=0;
        foreach($days as $day){
            $posts[] = Post::whereDate('created_at','=',$day)->where('user_id',Auth::id())->count();
        }
     //   dd($posts);
        $chart->dataset('Posts','line',$posts);
        $chart->labels($days);
      
        return view('author.dashboard',compact('todaysComments','chart'));
    }
    private function generateDateRange(Carbon $start_date, Carbon $end_date){
        $dates = [];
     
        for($date=$start_date; $date->lte($end_date); $date->addDay()){
            $dates[] = $date->format('Y-m-d');
       
        }
        return $dates;
    }
    public function post(){
        $posts = Post::where('user_id',Auth::user()->id)->get();
        return view('author.posts',compact('posts'));
    }
    
    public function comments(){
        return view('author.comments');
    }
    public function createPost(Request $request){
       // $this->validate
       return view('author.post');
    }
    public function storePost(CreatePost $request){
        // $this->validate
        $post = new Post();
        $post->title = $request['title'];
        $post->user_id = Auth::user()->id;
        $post->content = $request['content'];
        $post->save();
        return redirect()->back()->with('message','Post created successfully');
       // return redirect()->back()->withErrors($validator)->withInput('message','Post created successfully');
     }
     public function deletePost(Post $post)
     {
         $post->delete();
         return redirect()->back()->with('message','Post deleted successfully');
     }
     public function show(Post $post){
        return view('author.show',compact('post'));
    }
    public function edit(Post $post){
        return view('author.edit',$post);
    }
    public function update(Post $post,CreatePost $request){
            
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->update();
     
        return redirect()->back()->with('message','Post updated successfully');
    }
    public function delete(Post $post){
        $post->delete();
        return redirect()->back()->with('message','Post deleted successfully');
    }
}
