<?php

namespace App\Http\Controllers;
use App\Post;
use App\Comment;
use App\Charts\DashboardChart;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdate;
use Hash;
use Carbon\Carbon;
class UserController extends Controller
{
    // user dashboard controller
    public function __construct(){
        $this->middleware('auth');
      //  $this->middleware('checkRole:admin');
    }
    public function dashboard(){
        $chart = new DashboardChart;
        // Startdate is 30 days ago and the end date is today..
        $days = $this->generateDateRange(Carbon::now()->subDays(30),Carbon::now());
        $comments = [];
        $i=0;
        foreach($days as $day){
          //  $sql = Comment::whereDate('created_at','=','2019-06-15')->where('user_id',Auth::id());
            $comments[] = Comment::whereDate('created_at','=',$day)->where('user_id',Auth::id())->count();
        }
        $chart->dataset('Comments','line',$comments);
        $chart->labels($days);
        return view('user.dashboard',compact('chart'));
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date){
        $dates = [];
     
        for($date=$start_date; $date->lte($end_date); $date->addDay()){
            $dates[] = $date->format('Y-m-d');
       
        }
        return $dates;
    }
    public function comments(){
        return view('user.comments');
    }
    public function deleteComment(Comment $comment){
        // $comm = Comment::where('id',$id)->where('user_id',Auth::id()->first)
        $comment->delete();
        return redirect()->back()->with('message', 'Comment deleted Successfully');
    }
    public function addComments(Post $post,Request $request){
        // Auth::id() will work
        $user = Auth::user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $request['post'];
        $comment->content = $request['comment'];
        $comment->save(); 
        return back();
    }
    public function profile(){
        return view('user.profile');
    }
    public function updateProfile(UserUpdate $request){
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
       //$user->password = bcrypt($request['new_password']);
        //dd(encrypt($user->password));
        $user->save();
        //dd('test');
        if($request['password'] != ""){
           
            if(!(Hash::check($request['password'], Auth::user()->password))){
                return redirect()->back()->with('error','Your current password does not match with the password you provided...!' ); 
            }
            if(strcmp($request['password'],$request['new_password']) == 0){
                return redirect()->back()->with('error','New password cannot be same as your current password..!');
            }
           // dd('here fff');
            $validation = $request->validate([
                'password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
            ]);
            
            $user->password = bcrypt($request['new_password']);
            $user->save();
            return redirect()->back()->with('message', 'Profile updated Successfully');
        }
        
    }
    public function showPostDescription(Post $post){
        return view('user.post',compact('post'));
    }

}
