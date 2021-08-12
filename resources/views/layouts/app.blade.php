<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title','Blog 4 u')</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{asset('css/clean-blog.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/blog.css')}}" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{asset('js/clean-blog.min.js')}}"></script>
</head>
<body>
  <!-- Navigation -->
        <nav class="navbar  navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container ">
            <a class="navbar-brand" href="{{route('welcome')}}">BLOG 4 U</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shop.index')}}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">dashboard</a>
                </li>
                {{-- @if (Auth::check() && Auth::user()->admin) 
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('adminDashboard')}}">dashboard</a>
                  </li>
                @endif --}}
                </ul>
            </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </nav>
        <main>
            @yield('content')
        </main>
      </div>
    </body>
    <footer>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                  <ul class="list-inline text-center">
                    <li class="list-inline-item">
                      <a href="#">
                        <span class="fa-stack fa-lg">
                          <i class="fas fa-circle fa-stack-2x"></i>
                          <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <span class="fa-stack fa-lg">
                          <i class="fas fa-circle fa-stack-2x"></i>
                          <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <span class="fa-stack fa-lg">
                          <i class="fas fa-circle fa-stack-2x"></i>
                          <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                  </ul>
                  <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
                </div>
              </div>
            </div>
          </footer>
        
          
</html>
