@extends('layouts.auth')
@section('title')
    Login
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-5">
                <form method="POST" action="{{ route('login') }}">@csrf
                <div class="card p-4" >
                    <div class="card-header text-center text-uppercase h4 font-weight-light">
                        Login
                    </div>

                    <div class="card-body py-5">
                                      
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                        <input type="email" name="email" class="form-control {{$errors->has('email')? 'is-invalid' : ''}}">
                        </div>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback  d-block" role="alert">
                                    <strong>{{$errors->first('email')}}</strong>
                            </span>
                        @endif    

                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <input type="password" name="password" class="form-control {{$errors->has('password')? 'is-invalid' : ''}}">
                        </div>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                        @endif


                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="login">
                            <label class="custom-control-label" for="login">Remember me</label>
                        </div> --}}

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-5">Login</button>
                            </div>
                        
                                {{-- <a href="#" class="btn btn-link">Forgot password?</a>
                            </div> --}}
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>    
                        </div>
                    </div>

                </div>
             </form>
            </div>
        </div>
    </div>   
 @endsection 
