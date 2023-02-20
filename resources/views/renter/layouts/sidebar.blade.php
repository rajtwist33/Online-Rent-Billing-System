
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('renter.dashboard.index')}}" class="brand-link ">
    @if($org_name != null && $org_name->image != null)
      <img src="{{asset('settings/uploads/'.$org_name->image)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    @else
    <i class="fas fa-feather-alt brand-image img-circle elevation-3 m-2" style="opacity: .8"></i>
    @endif  
      <span class="brand-text font-weight-light {{ request()->routeIs('renter.dashboard.index') ? 'text-success' : '' }}">{{ $org_name == null ? "ORBS" : $org_name->organization_name  }}</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
          @if($data != '' )
            <img src="{{asset('rentowner/uploads/'.$data->image_path)}}" class="img-circle elevation-2"alt="image not found">
            @else
            <img src="{{asset('rentowner/default/dumy.png')}}" class="img-circle elevation-2"alt="image not found">
            @endif
          </div>
          <div class="info">
            <p  class="d-block text-light">{{ Auth::user()->name }}</p>
          </div>
        </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">      
          <li class="nav-header">General</li>
          <li class="nav-item ">
            <a href="{{route('renter.profile.index')}}" class=" nav-link {{ request()->routeIs('renter.profile.index')   ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-alt"></i>
              <p>
                 Profile
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('renter.room.index')}}" class=" nav-link {{ request()->routeIs('renter.room.index') || request()->routeIs('renter.room.edit') || request()->routeIs('renter.tenant.create')? 'active' : '' }}">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                 Room
              </p>
            </a>
          </li>  
          <li class="nav-item ">
            <a href="{{route('renter.tenant.index')}}" class=" nav-link {{ request()->routeIs('renter.tenant.index') || request()->routeIs('renter.payment.create') || request()->routeIs('renter.tenant.show') || request()->routeIs('renter.tenant.edit') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shapes"></i>
              <p>
                 Tenant
              </p>
            </a>
          </li>  
          <li class="nav-item ">
            <a href="{{route('renter.payment.index')}}" class=" nav-link {{ request()->routeIs('renter.payment.index')  || request()->routeIs('renter.payment.edit') || request()->routeIs('renter.payment.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shapes"></i>
              <p>
                 Tenant Payments
              </p>
            </a>
          </li>  
          <li class="nav-item ">
            <a href="{{ route('renter.change_password.index') }}" class=" nav-link {{ request()->routeIs('renter.change_password.index') ? 'active' : '' }}" >
            <i class="fas fa-key"></i>
              <p class="ml-1">
                Change Renter Password
              </p>
            </a>
          </li>  
        </ul>
      </nav>
    </div>
  </aside>
