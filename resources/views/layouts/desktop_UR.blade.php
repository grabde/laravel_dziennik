<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'E-dziennik') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
  </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-address-book"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Piotr Szkolnicki
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Dyrektor</p>
                <p class="text-sm text-muted"><i class="fas fa-phone-alt"></i> 678 257 341</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Janusz Pomocny
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Pedagog</p>
                <p class="text-sm text-muted"><i class="fas fa-phone-alt"></i> 678 257 342</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Janina Oczytana
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Bibliotekarka</p>
                <p class="text-sm text-muted"><i class="fas fa-phone-alt"></i> 678 257 343</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/contact').session('suffix') }}" class="dropdown-item dropdown-footer">Kontakt</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-map-marked-alt"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d155798.0005881212!2d16.761583566278414!3d52.400445769235624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470444d2ece10ab7%3A0xa4ea31980334bfd1!2zUG96bmHFhA!5e0!3m2!1sen!2spl!4v1606860669357!5m2!1sen!2spl" width="300" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-home"></i> Ul. Laravelska 666
            <span class="float-right text-muted text-sm">62-093 Poznań</span>
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E-dziennik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ session('name').' '.session('surname') }}</a>
        </div>
      </div>

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            @switch(session('who'))
                @case('U')
                    <a href="#" class="d-block">Twoje ID w systemie: {{ session('id') }}</a>
                    @break
                @case('R')
                    <a href="#" class="d-block">ID Twojego dziecka w systemie: {{ session('id') }}</a>
                    @break
            @endswitch
          </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Nawigacja</li>

          <li class="nav-item menu-open">
            <a href="{{ url('/home') }}" class="nav-link active" onclick="event.preventDefault(); document.getElementById('home-form').submit();">
              <i class="nav-icon fas fa-home"></i>
              <p>{{ __('Pulpit') }}</p>
            </a>
            <form id="home-form" action="{{ url('/home') }}" method="POST">
              @csrf
            </form>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('/marks') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('marks-form').submit();">
              <i class="nav-icon fas fa-edit"></i> 
              <p>{{ __('Oceny') }}</p>
            </a>
            <form id="marks-form" action="{{ url('/marks') }}" method="POST">
              @csrf
            </form>
          </li>

          <li class="nav-item" onclick="event.preventDefault(); document.getElementById('schedule-form').submit();">
            <a href="{{ url('/schedule') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>{{ __('Plan lekcji') }}</p>
            </a>
            <form id="schedule-form" action="{{ url('/schedule') }}" method="POST">
              @csrf
            </form>
          </li>

          <li class="nav-item">
            <a href="{{ url('/notes') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('notes-form').submit();">
              <i class="nav-icon fas fa-exclamation"></i>
              <p>
                Uwagi
              </p>
            </a>
            <form id="notes-form" action="{{ url('/notes') }}" method="POST">
              @csrf
            </form>
          </li>
          <li class="nav-header">Komunikacja</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Poczta
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{ url('/mail_compose') }}" class="nav-link active" onclick="event.preventDefault(); document.getElementById('mail_compose-form').submit();">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>
                    {{ __('Utwórz') }}
                  </p>
                </a>
                <form id="mail_compose-form" action="{{ url('/mail_compose') }}" method="POST">
                  @csrf
                </form>
              </li>

              <li class="nav-item">
                <a href="{{ url('/mail_received') }}" class="nav-link active" onclick="event.preventDefault(); document.getElementById('mail_received-form').submit();">
                  <i class="fas fa-envelope nav-icon"></i>
                  <p>
                    {{ __('Odebrane') }}
                  </p>
                </a>
                <form id="mail_received-form" action="{{ url('/mail_received') }}" method="POST">
                  @csrf
                </form>
              </li>

              <li class="nav-item">
                <a href="{{ url('/mail_sent') }}" class="nav-link active" onclick="event.preventDefault(); document.getElementById('mail_sent-form').submit();">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>
                    {{ __('Wysłane') }}
                  </p>
                </a>
                <form id="mail_sent-form" action="{{ url('/mail_sent') }}" method="POST">
                  @csrf
                </form>
              </li>

            </ul>
          </li>
          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt nav-icon"></i> 
                <p>{{ __('Wyloguj') }}</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; BDD.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
</body>
</html>