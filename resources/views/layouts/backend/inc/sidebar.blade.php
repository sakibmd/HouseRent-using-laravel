
<aside class="main-sidebar sidebar-dark-light elevation-4" style="background-color: rgb(61, 20, 20)">
    <!-- Brand Logo -->
    {{-- <a href="" class="brand-link text-center">
      <span class="brand-text font-weight-bold">{{ Auth::user()->role_id == 1 ? 'Admin Panel' : 'User Panel' }}</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image text-center">
          <img src="{{  Auth::user()->image != null ? asset('storage/profile_photo/'. Auth::user()->image) : asset('backend/img/user2-160x160.jpg') }}" style="height: 150px; width: 150px" class="img-circle elevation-2" alt="User Image">
          <br>
          <div style="color: honeydew;line-height: 4px; font-weight: 600" class="text-center mt-3 info">
              <p>Name: {{ Auth::user()->name }}</p>
              <p>Email: {{ Auth::user()->email }}</p>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          

          @if (Request::is('admin*'))
          <li class="nav-item has-treeview active">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="fas fa-border-style"></i>
              <p class="ml-2">
                Dashboard
              </p>
            </a>
          </li>
         

          <li class="nav-item has-treeview">
            <a href="{{ route('admin.area.index') }}" class="nav-link {{ Request::is('admin/area*') ? 'active' : '' }}">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <p class="pl-2">Areas</p>
            </a>
          </li>

          
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.house.index') }}" class="nav-link {{ Request::is('admin/house*') ? 'active' : '' }}">
              <i class="fa fa-home" aria-hidden="true"></i>
              <p class="pl-2">
                Houses
              </p>
            </a>
          </li>


          

          <li class="nav-item has-treeview">
            <a href="{{ route('admin.manage.landlord') }}" class="nav-link {{ Request::is('admin/manage-landlord') ? 'active' : '' }}">
              <i class="fas fa-laptop-house"></i>
              <p class="pl-2">
                Manage Landlords
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{ route('admin.manage.renter') }}" class="nav-link {{ Request::is('admin/manage-renter') ? 'active' : '' }}">
              <i class="fas fa-users-cog"></i>
              <p class="pl-2">
                Manage Renter
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{ route('admin.profile.show') }}" class="nav-link {{ Request::is('admin/profile-info') ? 'active' : '' }}">
              <i class="fas fa-user"></i>
              <p class="pl-2">
                Profile Info
              </p>
            </a>
          </li>
          @endif

          @if (Request::is('landlord*'))
            <li class="nav-item has-treeview">
              <a href="{{ route('landlord.dashboard') }}" class="nav-link {{ Request::is('landlord/dashboard') ? 'active' : '' }}">
                <i class="fas fa-border-style"></i>
                <p class="pl-2">
                  Dashboard
                </p>
              </a>
            </li>


            <li class="nav-item has-treeview">
              <a href="{{ route('landlord.area.index') }}" class="nav-link {{ Request::is('landlord/area*') ? 'active' : '' }}">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <p class="pl-2">Area</p>
              </a>
            </li>

            <li class="nav-item has-treeview">
              <a href="{{ route('landlord.house.index') }}" class="nav-link {{ Request::is('landlord/house*') ? 'active' : '' }}">
                <i class="fa fa-home" aria-hidden="true"></i>
                <p class="pl-2">
                  House
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview">
              <a href="{{ route('landlord.profile.show') }}" class="nav-link {{ Request::is('landlord/profile-info') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <p class="pl-2">
                  Profile Info
                </p>
              </a>
            </li>
          @endif


          @if (Request::is('renter*'))
          <li class="nav-item has-treeview">
            <a href="{{ route('renter.dashboard') }}" class="nav-link {{ Request::is('renter/dashboard') ? 'active' : '' }}">
              <i class="fas fa-border-style"></i>
              <p class="pl-2">
                Dashboard
               
              </p>
            </a>
          </li>
        @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
