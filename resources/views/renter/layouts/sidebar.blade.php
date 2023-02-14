
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('developer.dashboard.index')}}" class="brand-link ">
    @if($org_name != null && $org_name->image != null)
      <img src="{{asset('settings/uploads/'.$org_name->image)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    @else
      <img src="{{asset('layouts/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    @endif  
      <span class="brand-text font-weight-light {{ request()->routeIs('developer.dashboard.index') ? 'text-success' : '' }}">{{ $org_name == null ? "ORBS" : $org_name->organization_name  }}</span>
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
          <li class="nav-item ">
            <a href="{{route('developer.setting.index')}}" class=" nav-link {{ request()->routeIs('developer.setting.index') || request()->routeIs('developer.setting.edit')   ? 'active' : '' }}">
            <i class="fas fa-cogs"></i>
              <p class="ml-1">
                Setting
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('developer.password_change.index') }}" class=" nav-link {{ request()->routeIs('developer.password_change.index') ? 'active' : '' }}" >
            <i class="fas fa-key"></i>
              <p class="ml-1">
                Change Developer Password
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
    </div>
  </aside>
