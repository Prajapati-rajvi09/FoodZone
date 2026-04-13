<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FoodZone | Admin Panel</title>

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Custom Premium Styles -->
  <link rel="stylesheet" href="{{asset('dist/css/admin_custom.css')}}">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <style>
      .preloader { background: #fff; }
      .brand-text { font-weight: 700 !important; letter-spacing: 1px; color: #fff !important; }
  </style>
  @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
 
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <div class="spinner-border text-danger" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="adminindex" class="nav-link">Dashboard</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="login" class="nav-link btn btn-outline-danger btn-sm px-3 ml-2" style="border-radius: 20px;">
          <i class="fas fa-sign-out-alt mr-1"></i> Logout
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-0">
    <a href="adminindex" class="brand-link text-center">
      <span class="brand-text">FOOD<span style="color: #FF6B6B">ZONE</span></span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-4 pb-4 mb-4 d-flex align-items-center">
        <div class="image">
          <img src="{{asset('images/images.jpeg')}}" class="img-circle elevation-2" alt="User Image" style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #FF6B6B;">
        </div>
        <div class="info ml-2">
          <a href="#" class="d-block font-weight-bold" style="color: #fff; font-size: 1.1rem;">Administrator</a>
          <span class="badge badge-success" style="font-size: 0.6rem; text-transform: uppercase;">Online</span>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="adminindex" class="nav-link {{ request()->is('adminindex') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header" style="color: rgba(255,255,255,0.4); font-size: 0.7rem; letter-spacing: 1px; margin-top: 15px;">MANAGEMENT</li>

          <li class="nav-item {{ request()->is('product*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('product*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-utensils"></i>
              <p>Catalog <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="/product" class="nav-link {{ request()->is('product') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Categories</p></a></li>
              <li class="nav-item"><a href="/productentry" class="nav-link {{ request()->is('productentry') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Add Product</p></a></li>
              <li class="nav-item"><a href="/productentryview" class="nav-link {{ request()->is('productentryview') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>View All</p></a></li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('customer*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('customer*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Users <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="customerview" class="nav-link {{ request()->is('customerview') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>User List</p></a></li>
              <li class="nav-item"><a href="customerfeedback" class="nav-link {{ request()->is('customerfeedback') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Feedbacks</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="customerorder" class="nav-link {{ request()->is('customerorder') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>Orders</p>
            </a>
          </li>

          <li class="nav-header" style="color: rgba(255,255,255,0.4); font-size: 0.7rem; letter-spacing: 1px; margin-top: 15px;">SETTINGS</li>

          <li class="nav-item">
            <a href="/Pincode" class="nav-link {{ request()->is('Pincode') ? 'active' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>Service Areas</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
       <div class="container-fluid">
          @yield('header')
       </div>
    </div>
    <div class="content">
       <div class="container-fluid">
          @yield('content')
       </div>
    </div>
  </div>

  <footer class="main-footer" style="background: transparent; border: none; font-size: 0.9rem;">
    <div class="float-right d-none d-sm-block"><b>Version</b> 2.0.0</div>
    <strong>&copy; 2026 <a href="#" style="color: #FF6B6B">FoodZone Admin</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- SCRIPTS -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({ "responsive": true, "autoWidth": false });
    $('.dataTable').DataTable({ "responsive": true, "autoWidth": false });
  });
</script>
@yield('scripts')
</body>
</html>
