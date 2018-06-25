<header class="main-header">
    <!-- Logo -->
    <a href="{{url('admin/home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">后台</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/adminlte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        {{----}}
                        <span class="hidden-xs">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</span>
                    </a>
                </li>
                <div class="pull-right">
                    <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
            </ul>
        </div>
    </nav>
</header>