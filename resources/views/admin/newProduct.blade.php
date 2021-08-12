@extends('layouts.admin')
@section('title')
    New Product
@endsection
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>

                <div class="card-body">
                <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">@csrf
                    <div class="card " >
                            
                        <div class="card-body ">

                            <div class="form-group">
                                <label class="form-control-label">Thumbnail</label>
                                <input type="file" name="thumbnail" value="{{old('thumbnail')}}" class="form-control {{$errors->has('thumbnail')? 'is-invalid' : ''}}">
                            </div>

                            @if ($errors->has('thumbnail'))
                                <span class="invalid-feedback  d-block" role="alert">
                                        <strong>{{$errors->first('thumbnail')}}</strong>
                                </span>
                            @endif
                                                
                            <div class="form-group">
                                <label class="form-control-label">Title</label>
                                <input type="text" name="title" placeholder="Product Title" value="{{old('title')}}" class="form-control {{$errors->has('email')? 'is-invalid' : ''}}">
                            </div>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback  d-block" role="alert">
                                        <strong>{{$errors->first('title')}}</strong>
                                </span>
                            @endif    

                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                <textarea name="description" placeholder="Product Description" class="form-control {{$errors->has('description')? 'is-invalid' : ''}}">{{old('description')}}</textarea>
                            </div>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$errors->first('description')}}</strong>
                                </span>
                            @endif

                            <div class="form-group">
                                <label class="form-control-label">Price</label>
                                <input type="text" name="price" placeholder="10.00" value="{{old('price')}}" class="form-control {{$errors->has('price')? 'is-invalid' : ''}}">
                            </div>

                            @if ($errors->has('price'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$errors->first('price')}}</strong>
                                </span>
                            @endif

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Create</button>
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