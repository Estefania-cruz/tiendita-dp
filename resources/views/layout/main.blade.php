<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @yield('titulo')

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  @yield('css')
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg  navbar-purple">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link navbar-white align-content-center">Inicio</a>
      </li>
      @if (session('usuario'))
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('sign-out') }}" class="nav-link"><span class="fas fa-sign-out-alt"></span></a>
      </li>
      @else
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('registro') }}" class="nav-link navbar-white">Registrate para ver mas productos</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login') }}" class="nav-link navbar-white">Inicia sesion por favor</span></a>
      </li>
      @endif
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-fuchsia elevation-5 ">

    <a href="{{ route('home') }}" class="brand-link navbar-pink" >
      <span class="brand-text  font-weight-bold" >Bienvenido a tiendita</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar  flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (session('usuario'))
          <li class="nav-item">
            <a href="{{ route('perfil', ['id' => session('usuario')->id, 'nombre' => session('usuario')->nombre]) }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Perfil
              </p>
            </a>
          </li>
          @if (session('usuario')->tipo_usuario == 1)
          <li class="nav-item">
            <a href="{{ route('addProducto') }}" class="nav-link">
              <i class="navbar-pink"></i>
              <p>
                Agregar productos al sistema
              </p>
            </a>
          </li>
          @endif
          @if (session('usuario')->tipo_usuario == 2)
          <li class="nav-item">
            <a href="{{ route('misPedidos') }}" class="nav-link">
              <i class="navbar-pink"></i>
              <p>
                Mis pedidos realizados
              </p>
            </a>
          </li>
          @endif
          @if (session('usuario')->tipo_usuario == 1)
          <li class="nav-item">
            <a href="{{ route('pedidos') }}" class="nav-link">
              <i class="navbar-pink"></i>
              <p>
                Total pedidos que sean realizado
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('productos') }}" class="nav-link">
              <i class="navbar-pink"></i>
              <p>
                Productos en existencia
              </p>
            </a>
          </li>
          @endif
          @if (session('usuario')->tipo_usuario == 2)
          <li class="nav-item">
            <a href="{{ route('miCarrito') }}" class="nav-link">
              <i class="navbar-pink"></i>
              <p>
                Mi carrito de compras
              </p>
            </a>
          </li>
          @endif
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header">
      <div class="container-fluid" >

        @yield('contenido')

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer navbar-pink">
    <strong>Copyright &copy; 2021 ABRIL <a href="">Estefania Cristobal de la cruz</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block navbar-pink">
      <b>Version ;)</b> 001
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

@yield('js')

</body>
</html>
