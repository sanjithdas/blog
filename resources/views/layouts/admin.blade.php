<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','BLOG 4 U')</title>
    <link rel="stylesheet" href="{{asset('admin/vendor/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/styles.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="sidebar-fixed header-fixed" >
<div class="page-wrapper">
    @include('includes.admin.headerNavigation')
    <div class="main-container">
        @include('includes.admin.sidebarNavigation')    
         @yield('content')
    </div>
</div>
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/popper.js/popper.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script> 

<script src="{{asset('admin/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{asset('admin/js/carbon.js')}}"></script>
<script src="{{asset('admin/js/demo.js')}}"></script>
</body>
</html>
