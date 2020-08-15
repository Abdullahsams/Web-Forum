<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/posts" class="nav-link">Beranda</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 
    @auth           
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/posts/logout" class="nav-link">Logout</a>
      </li>
    @endauth

    @guest
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login') }}" class="nav-link">Login</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('register') }}" class="nav-link">Register</a>
      </li>
    @endguest

    </ul>
  </nav>