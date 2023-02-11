<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ORBS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('layouts/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('layouts/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

@include('developer.layouts.header')
@include('developer.layouts.sidebar')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('developer.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @yield('main-body')
        </div>
      </div>
    </div>
  </section>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
@include('developer.layouts.footer')
</div>
<script src="{{asset('layouts/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('layouts/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('layouts/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('layouts/dist/js/adminlte.js') }}"></script>
<script src="{{asset('layouts/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('layouts/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('layouts/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('layouts/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<script src="{{asset('layouts/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('layouts/dist/js/demo.js') }}"></script>
<script src="{{asset('layouts/dist/js/pages/dashboard2.js') }}"></script>
</body>
</html>
