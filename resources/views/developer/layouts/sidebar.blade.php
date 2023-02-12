<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('developer.dashboard.index')}}" class="brand-link ">
      <img src="{{asset('layouts/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light {{ request()->routeIs('developer.dashboard.index') ? 'text-success' : '' }}">ORBS</span>
    </a>
    <div class="sidebar">
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">      
          <li class="nav-header">General</li>
          <li class="nav-item ">
            <a href="{{route('developer.tenantowner.index')}}" class=" nav-link {{ request()->routeIs('developer.tenantowner.index') || request()->routeIs('developer.tenantowner.edit')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Renter
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
    </div>
  </aside>
