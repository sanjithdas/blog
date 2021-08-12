@extends('layouts.app')
@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Web Shop</h1>
                <span class="subheading">Super cool things 4 you</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container align-" style="width:900px;margin:0 auto;border-block-end-color: blueviolet">
    <div class="row align-items-center">
      @if($products->count()>0) 
        @foreach ($products as $product)
        <div class="col-4 mt-3">
          <div class="row">
              <div class="col-6">
                <img src="{{asset($product->thumnail)}}" width="100" height=70>
              </div>
              <div class="col-6">
                <a href="{{route('product.show',$product)}}">
                    <h6>
                        {{$product->title}}
                    </h6>
                </a>
                <small>
                  {{$product->price}} USD <br>
                  {{date_format($product->created_at, 'F d, Y')}}
                </small>
              </div>           
          </div>
          <hr>
        </div>
        @endforeach 
        {{-- {{$posts->links()}} --}}
      @endif  
        <!-- Pager -->
        {{-- <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div> --}}
      
    </div>
  </div>


  @endsection