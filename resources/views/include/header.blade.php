<header class="main-header">

  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{ asset('dist/img/logo.png') }}"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="color: #484344;"><b>بنك البركة </b><img src="{{ asset('dist/img/logo.png') }}"></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu" style="z-index: 99999;">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu" style="float: right;" onclick="getTheLastNotifications()" id="notification_navbar_list">
          @include('include.notification') 
        </li>
        <!-- /.messages-menu -->
        <!-- User Account Menu -->
        <li class="dropdown user user-menu" style="float: right !important;">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{ asset('dist/img/avatar.png') }}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">لؤي الاسدي </span>
          </a>
<!--           <ul class="dropdown-menu">
            <li class="user-header">
              <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle" alt="User Image">

              <p>
                Auth::user()->role->name 
                <small>Member since Nov. 2012</small>
              </p>
            </li>
          </ul> -->
        </li>
      </ul>
    </div>
  </nav>
</header>
