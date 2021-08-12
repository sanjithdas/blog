<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">User</li>

                <li class="nav-item">
                    <a href="{{route('user.dashboard')}}" class="nav-link {{ Route::currentRouteName()=='user.dashboard' ? 'active' : '' }} ">
                        <i class="icon icon-speedometer"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item nav-dropdown">
                <a href="{{route('user.comments')}}" class="nav-link {{Route::currentRouteName()=='user.comments'?'active':'' }}">
                        <i class="icon icon-book-open"></i> Comments
                    </a>
            @if (Auth::user()->author || Auth::user()->admin)        
                <li class="nav-title">Author</li>

                <li class="nav-item nav-dropdown">
                    <a href="{{route('author.dashboard')}}" class="nav-link {{Route::currentRouteName()=='author.dashboard'?'active':'' }}">
                        <i class="icon icon-speedometer"></i> Dashboard 
                    </a>
                </li>

                <li class="nav-item nav-dropdown">
                    <a href="{{route('author.posts')}}" class="nav-link {{Route::currentRouteName()=='author.posts'?'active':'' }}">
                        <i class="icon icon-paper-clip"></i> Posts 
                    </a>
                </li>
                
                <li class="nav-item nav-dropdown">
                    <a href="{{route('author.comments')}}" class="nav-link {{Route::currentRouteName()=='author.comments'?'active':'' }}">
                        <i class="icon icon-book-open"></i> Comments 
                    </a>
                </li>
            @endif

          
                <li class="nav-title">
                    Admin
                </li>

                <li class="nav-item nav-dropdown">
                        <a href="{{route('adminDashboard')}}" class="nav-link {{Route::currentRouteName()=='adminDashboard'?'active':'' }}">
                            <i class="icon icon-speedometer"></i> Dashboard 
                        </a>
                    </li>
    
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('admin.posts')}}" class="nav-link {{Route::currentRouteName()=='admin.posts'?'active':'' }}">
                            <i class="icon icon-paper-clip"></i> Posts 
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                            <a href="{{route('admin.products')}}" class="nav-link {{Route::currentRouteName()=='admin.products'?'active':'' }}">
                                <i class="icon icon-basket-loaded"></i> Products 
                            </a>
                    </li>
                   
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('admin.comments')}}" class="nav-link {{Route::currentRouteName()=='admin.comments'?'active':'' }}">
                            <i class="icon icon-book-open"></i> Comments 
                        </a>
                    </li>
    
                <li class="nav-item">
                    <a href="{{route('admin.users')}}" class="nav-link">
                        <i class="icon icon-user"></i> Users
                    </a>
                </li>
          
               
            </ul>
        </nav>
    </div>

    