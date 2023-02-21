<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
      <form action="{{route('renter.dashboard.store')}}" method="post">
          @csrf
            <input type="hidden" value="{{Auth::user()->sidebar}}" name="sidebar" id="">
            <button type="submit" class="btn text-light d-none d-lg-block "><i class="fas fa-bars"></i></button>
            <a class="nav-link d-lg-none " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </form> 
       
        
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <p class="mt-2 ml-2 text-light">{{Auth::user()->name}}</p>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <form action="{{route('logout')}}" method="get">
          @csrf
          <button type="submit" class="nav-link btn conform_logout" data-toggle="tooltip" title='Power Buttom'> <i class="fas fa-power-off mr-3 text-danger"></i></button>
      </form> 
      </li>
    </ul>
  </nav>