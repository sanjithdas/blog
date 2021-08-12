@extends('layouts.app')
@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>{{remove_spaces('Blog 4 U')}}</h1>
            {{-- <span class="subheading">Blog</span> --}}
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
   
    <div class="row">
      
      <div class="col-lg-8 col-md-10 mx-auto">
        
       @if($posts->count()>0) 
        @foreach ($posts as $post)
       
          <div class="post-preview">
              <a href="{{route('single.post.show',$post)}}">
              <h2 class="post-title">
                {{$post->title}}
              </h2>
              </a>
              <p class="post-sub-title">
                  {{$post->content}}
              </p>
            <p class="post-meta">Posted by
              <a href="#">{{$post->user['name']}}</a>
              on {{date_format($post->created_at, 'F d, Y')}}</p>
              <p>
                <i class="fa fa-comment" aria-hidden="true"></i> {{$post->comments->count()}}
              </p>  
          </div>
          <hr>
        @endforeach 
        {{$posts->links()}}
      @endif  
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="http://localhost:8000/?page=2">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>
    
  @endsection
