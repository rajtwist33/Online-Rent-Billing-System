<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <p class="mt-2 ml-2 text-light">{{Auth::user()->name}}</p>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      
     
      <li class="nav-item">
        <a class="nav-link"  href="{{route('logout')}}" class ="btn btn-sm btn-danger">
        <i class="fas fa-power-off mr-3 text-danger"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>