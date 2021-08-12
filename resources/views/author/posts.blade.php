@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">My Posts</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Comments</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td class="text-nowrap"><a href="{{route('post.show',$post->id)}}">{{$post->title}}</a></td>
                                    <td>{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</td>
                                    <td>{{\Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</td>
                                    <td>{{$post->comments->count()}}</td>
                                    <td><a class="btn btn-danger" href="{{route('post.edit',$post->id)}}">Edit</a></td>
                                    <td><a class="btn btn-danger" href="{{route('post.delete',$post->id)}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         
         
        @if(Session::has('message'))
            <div class="alert alert-success text-center">{{Session::get('message')}}</div>
        @endif
    </div>
@endsection