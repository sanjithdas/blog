@extends('layouts.admin')
@section('title')
    Edit Post - {{$title}}
@endsection
@section('content')
    <div class="content">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post </div>
    
                    <div class="card-body">
                <form method="POST" action="{{ route('post.update',$id) }}">@csrf
                    <div class="card " >
                            
                        <div class="card-body ">
                                                
                            <div class="form-group">
                                <label class="form-control-label">Title</label>
                            <input type="text" name="title" value="{{ $title ?? old('title') }}" class="form-control {{$errors->has('email')? 'is-invalid' : ''}}">
                            </div>
    
                            @if ($errors->has('title'))
                                <span class="invalid-feedback  d-block" role="alert">
                                        <strong>{{$errors->first('title')}}</strong>
                                </span>
                            @endif    
    
                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                            <textarea name="content" class="form-control {{$errors->has('password')? 'is-invalid' : ''}}">{{$content ?? old('content')}}</textarea>
                            </div>
    
                            @if ($errors->has('content'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$errors->first('content')}}</strong>
                                </span>
                            @endif

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary px-5">Edit</button>
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