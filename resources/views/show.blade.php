
@extends('layouts.app')
@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image:url('{{asset('img/post-bg.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$posts->title}}</h1>
            
            <span class="meta">Posted by
              <a href="#">{{$posts->user->name}}</a>
              on {{date_format($posts->created_at, 'F d, Y')}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <p>{{nl2br($posts->content)}}.</p>
          
          </div>
        </div>
        <div class="comments">
            <h5>Comments:-</h5>
          @foreach ($posts->comments as $comment)
            <div>&nbsp;&nbsp;{{$comment->content}}
              <small><br>
                &nbsp;&nbsp;
                  by {{$comment->user->name}},on 
                  {{date_format($comment->created_at, 'F d, Y')}}
              </small>
            </div>
           @endforeach 
         
           @if(Auth::check())
              <form action="{{route('add.comments')}}" method="post">@csrf
                <input type="hidden" name="post" value="{{$posts->id}}">
                <div class="form-group">
                  <textarea class="form-control" placeholder="Comment..." name="comment" id="" rows="6"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Add Comment</button>
                </div>
              </form>
           @endif
         


        </div>
      </div>
    </article>
  @endsection
 

  
