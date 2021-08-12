@extends('layouts.app')
@section('title')
   {{$product->title}}
@endsection
@section('content')
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1> {{$product->title}}</h1>
                <span class="subheading">Super {{$product->title}} 4 you</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="content"  style="width:700px;margin:0 auto;">
        <div class="card">
            <div class="card-header text-center">{{$product->title}}</div>
            <div class="card-body text-justify">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-7">
                                    <img src="{{asset($product->thumnail)}}" width="380" height="240">
                            </div>
                            <div class="col-5">
                                <a href="{{route('product.show',$product)}}">
                                    <h6>
                                        {{$product->title}}
                                    </h6>
                                </a>
                                <small>
                                    {{$product->price}} USD <br>
                                    {{date_format($product->created_at, 'F d, Y')}}
                                </small>
                                <hr>
                                
                                    <div id="paypal-button">
                                        @csrf
                                    </div>
                                

                                <a class="btn btn-dark" href="{{route('product.order',$product->id)}}">Pay with paypal</a> 
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="details-heading">
                            Description:-
                    </div>
                    <div class="mt-5 col text-left">
                        {{$product->description}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    env: 'sandbox', // Or 'production'
    // Set up the payment:
    // 1. Add a payment callback
    style:{
        size: 'medium',
        color:'gold',
        shape:'pill',
    },
    payment: function(data, actions) {
     //   console.log(@csrf);
      
      // 2. Make a request to your server
      return actions.request.get('{{$product->id}}/order',{
       
      })
        .then(function(res) {
          // 3. Return res.id from the response
          
          console.log("ssssssssssss"+res);
          return res.id;
        });
    },
    // Execute the payment:
    // 1. Add an onAuthorize callback
    onAuthorize: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('{{$product->id}/executeOrder', {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {
          // 3. Show the buyer a confirmation message.
        });
    }
  }, '#paypal-button');
</script>