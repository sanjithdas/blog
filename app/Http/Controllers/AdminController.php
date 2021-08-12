<?php

namespace App\Http\Controllers;
use App\Charts\DashboardChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Post;
use App\Product;
use App\Comment;
use App\User;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserUpdate;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }
    public function dashboard(){
        $posts = Post::all();
        $chart = new DashboardChart;
        // Startdate is 30 days ago and the end date is today..
        $days = $this->generateDateRange(Carbon::now()->subDays(30),Carbon::now());
        $posts = [];
        $i=0;
        foreach($days as $day){
          //  $sql = Comment::whereDate('created_at','=','2019-06-15')->where('user_id',Auth::id());
            $posts[] = Post::whereDate('created_at','=',$day)->count();
        }
        
        $chart->dataset('Posts','line',$posts)->options([
            'color' => '#8B0000',
        ]);;
        
       // $chart->color('#8B0000');
        $chart->labels($days);
        $chart->loaderColor('red');
        return view('admin.dashboard',compact('posts','chart'));
    }
    private function generateDateRange(Carbon $start_date, Carbon $end_date){
        $dates = [];
     
        for($date=$start_date; $date->lte($end_date); $date->addDay()){
            $dates[] = $date->format('Y-m-d');
       
        }
        return $dates;
    }
    public function post(){
        $posts = Post::all();
        return view('admin.posts',compact('posts'));
    }
    
    public function comments(){
        $comments = Comment::all();
        //dd($comments);
        return view('admin.comments',compact('comments'));
    }
    public function users(){
        $users = User::all();
        return view('admin.users',compact('users'));
    }
    public function show(Post $post){
        return view('admin.show',compact('post'));
    }
    public function edit(Post $post){
        return view('admin.edit',$post);
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

    public function deleteComment(Comment $comment){
        $comment->delete();
        return redirect()->back()->with('message','Comment deleted successfully');
    }
    public function deleteUsers(User $user){
        $user->delete();
        return redirect()->back()->with('message','User deleted successfully');
    }
    public function editUsers(User $user){
        return view('admin.editUser',compact('user'));
    }
    public function updateUsers(User $user, UserUpdate $request){
       // dd('iam ');
        $user->name=$request['name'];
        $user->email=$request['email'];
        if ($request['admin']==1)
            $user->admin=true;
        if ($request['author']==1)
            $user->author=true;
        $user->update();
        return redirect()->back()->with('message','User updated successfully');
        //return view('admin.editUser',compact('user'));
    }
    public function products(){
        $products = Product::all();
        return view('admin.products',compact('products'));
    }
    public function createProduct(Request $request){
       
        return view('admin.newProduct');
        
    }
    public function storeProduct(Request  $request){
        $this->validate($request,[
            'title' => 'required|string',
            'thumbnail' => 'required|file',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ]);
        $product = new Product();
        $product->title= $request['title'];
        
        $product->description= $request['description'];
        $product->price= $request['price'];

        $thumbnail= $request->file('thumbnail');
        $fileName = $thumbnail->getClientOriginalName();
        $fileExt = $thumbnail->getClientOriginalExtension();
        $thumbnail->move('product-images',$fileName);
        $product->thumnail = 'product-images/'. $fileName;
        $product->save();
        return redirect()->back()->with('message','Product created successfully!!!');
       
    }
    public function editProduct(Product $product){
       return view('admin.editProduct',compact('product')) ;
    }
    public function updateProduct(Product $product,Request $request){
       // dd($product);
        $this->validate($request,[
            'title' => 'required|string',
            'thumbnail' => 'file',
            'description' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ]);
        $product->title= $request['title'];
        $product->description= $request['description'];
        $product->price= $request['price'];
        if($request->hasFile('thumbnail')){
            $thumbnail= $request->file('thumbnail');
            $fileName = $thumbnail->getClientOriginalName();
            $fileExt = $thumbnail->getClientOriginalExtension();
            $thumbnail->move('product-images',$fileName);
            $product->thumnail = 'product-images/'. $fileName;
        }
        $product->update();
        return redirect()->back()->with('message','Product updated successfully!!!');

    }
    public function deleteProduct(Product $product,Request $request){
        $product->delete();
        $request->session()->flash('message', 'Product deleted successfully!');
        return back();
    }
}
