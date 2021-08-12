@extends('layouts.admin')
@section('title')
   Edit User
@endsection
@section('content')
    <div class="content">
            <div class="container">
                    <form method="post" action="{{route('users.update',$user)}}">
                            @csrf
                    <div class="row justify-content-center">
                        <input type="hidden" name="id"> 
                        <div class="col-md-8">
                            <div class="card p-4">
                                <div class="card-header h5 font-weight-light">
                                    Editing {{$user->name}}
                                </div>
                
                                <div class="card-body py-5">
                                     
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" name="name" value="{{isset($user->name)?$user->name: old('name')}}" class="form-control {{$errors->has('name')? 'is-invalid' : ''}}">
                                    </div>
                    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback  d-block" role="alert">
                                                <strong>{{$errors->first('name')}}</strong>
                                        </span>
                                    @endif   
                
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="text" name="email" value="{{isset($user->email)? $user->email:old('email')}}" class="form-control {{$errors->has('email')? 'is-invalid' : ''}}">
                                    </div>
                
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback  d-block" role="alert">
                                                <strong>{{$errors->first('email')}}</strong>
                                        </span>
                                    @endif   
                                        
                                    <div class="form-group">
                                        <label class="form-control-label mr-3">Permissions:</label>
                                        <input type="checkbox" class="form-control-sm" name="author" value=1 {{$user->author==true ? 'checked' : ''}}>Author
                                        <input type="checkbox" class="form-control-sm ml-2" name="admin" value=1 {{$user->admin==true? 'checked':''}}>Admin
                                        
                                    </div>
                                    
                                </div>
                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </form>
                @if(Session::has('message'))
                <div class="alert alert-success text-center">{{Session::get('message')}}</div>
            @endif
                </div>
    </div>
@endsection
