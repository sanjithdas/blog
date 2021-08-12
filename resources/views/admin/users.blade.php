@extends('layouts.admin')
@section('title')
    Users
@endsection
@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>
                     <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-dark">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td class="text-nowrap">{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        
                                        <?php
                                            $userType ='';
                                            if ($user->admin==1){
                                                $userType ='Admin';
                                            }
                                            elseif ($user->author==1) {
                                                $userType ='Author';
                                            }
                                            else{
                                                $userType= 'User';
                                            }
                                            
                                        ?>   

                                        <td  class="text-nowrap">{{$userType}}</td>
                                        <td  class="text-nowrap">{{$user->posts->count()}}</td>
                                        <td  class="text-nowrap">{{$user->comments->count()}}</td>
                                        <td class="text-nowrap">{{$user->created_at->diffForHumans()}}</td>
                                        <td class="text-nowrap">{{$user->updated_at->diffForHumans()}}</td>
                                        {{-- <td class="text-nowrap"><a href="{{route('this.post.details',$comment->post->id)}}">{{$comment->post->title}}</a></td>
                                        <td>{{$comment->content}}</td>
                                        <td>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</td> --}}
                                        <td><a class="btn btn-warning btn-sm" href="{{route('users.edit',$user->id)}}"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                        {{-- <td><a class="btn btn-danger btn-sm" href="{{route('users.delete',$user->id)}}">x</a> --}}

                                        <form style="display: none" id="deleteUser-{{$user->id}}" action="{{route('users.delete',$user->id)}}" method="POST">@csrf</form>     
                                        <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('deleteUser-{{$user->id}}').submit()">X</button>
                                        </td>
                                           
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

