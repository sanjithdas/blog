@extends('layouts.admin')
@section('title')
    Products
@endsection
@section('content')
    <div class="content">
        <div class="card">
                <a href="{{route('admin.product.create')}}"><button class="btn btn-dark">New Product</button></a>
            <div class="card-header bg-light">Products
             
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th colspan="2">Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img src="{{asset($product->thumnail)}}" width="100" height=70></td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}USD</td>
                                    {{-- <td class="text-nowrap"><a href="{{route('post.show',$post->id)}}">{{$post->title}}</a></td>
                                    <td>{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</td>
                                    <td>{{\Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</td>
                                    <td>{{$post->comments->count()}}</td> --}}
                                    <td><a class="btn btn-danger" href="{{route('admin.product.edit',$product->id)}}">Edit</a></td>
                                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal-{{$product->id}}">Delete</button></td>
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
    @foreach ($products as $product)
      <!-- Modal -->
          <div class="modal fade" id="deleteProductModal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">You are about to delete {{$product->title}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are you sure?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                  <form method="post" id="deleteProduct-{{$product->id}}" action="{{route('admin.product.delete',$product->id)}}"> @csrf
                    <button type="submit" class="btn btn-primary">Yes, delete it.</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
    @endforeach

@endsection