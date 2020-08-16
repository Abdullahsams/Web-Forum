<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Flow Overstack</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      @auth
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        
          <div class="info">
            <a href="#" class="d-block"> {{Auth::user()->name}} </a>
          </div>
      </div>

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <h5> 
                <i class="nav-icon fas fa-hand-sparkles"></i> Partisipasi
                <span class="badge badge-info right"> {{Auth::user()->profiles->point}} </span>
              </h5>             
            </a>
          </li>
        </ul>
      </div>
      @endauth

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/posts" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Beranda Umum
              </p>
            </a>
          </li>
          
          @auth
            <li class="nav-item">
              <a href="/posts/mypost" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Pertanyaanku
                </p>
              </a>
            </li>
          @endauth          
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>