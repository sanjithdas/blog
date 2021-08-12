@extends('layouts.admin')
@section('title')
    New Post
@endsection
@section('content')
    <div class="content">
            <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Create Post</div>
            
                            <div class="card-body">
                        <form method="POST" action="{{ route('post.store') }}">@csrf
                            <div class="card " >
                                    
                                <div class="card-body ">
                                                        
                                    <div class="form-group">
                                        <label class="form-control-label">Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control {{$errors->has('email')? 'is-invalid' : ''}}">
                                    </div>
            
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback  d-block" role="alert">
                                                <strong>{{$errors->first('title')}}</strong>
                                        </span>
                                    @endif    
            
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea name="content" class="form-control {{$errors->has('password')? 'is-invalid' : ''}}"></textarea>
                                    </div>
            
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$errors->first('content')}}</strong>
                                        </span>
                                    @endif

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary px-5">Create</button>
                                    </div>
                                    @if(Session::has('message'))
                                        <div class="alert alert-success">{{Session::get('message')}}</div>
                                    @endif

                                </form>          
                                        
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection