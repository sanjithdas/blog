@extends('layouts.admin')
@section('title')
    Author - Comments
@endsection
@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                     <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Post</th>
                                    <th>Coment</th>
                                    <th>Created At</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (Auth::user()->comments as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td class="text-nowrap"><a href="{{route('this.post.details',$comment->post->id)}}">{{$comment->post['title']}}</a></td>
                                        <td>{{$comment->content}}</td>
                                        <td>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</td>
 
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-success text-center" style="color:black">{{Session::get('message')}}</div>
        @endif
    </div>
@endsection