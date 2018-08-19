@php
  $parseUrl = parse_url(url()->full());
@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Usuario</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- Optionally, you can add icons to the links -->
      <li class="{{ substr($parseUrl['path'], 0, 12) === '/admin/index' ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
      </li>

      <li class="{{ substr($parseUrl['path'], 0, 8) === '/profile' ? 'active' : '' }}">
        <a href="{{ route('profile.view') }}"><i class="fa fa-user"></i> <span>Profile</span></a>
      </li>

      <li class="{{ substr($parseUrl['path'], 0, 16) === '/user-management' ? 'active' : '' }}">
        <a href="{{ route('user-management.index') }}"><i class="fa fa-users"></i> <span>User management</span></a>
      </li>
      <li class="treeview {{ substr($parseUrl['path'], 0, 18) === '/access-management' ? 'active' : '' }}">
        <a href="#"><i class="fa fa-key"></i> <span>Access Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ substr($parseUrl['path'], 0, 24) === '/access-management/roles' ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}">Role</a>
          </li>
          <li class="{{ substr($parseUrl['path'], 0, 29) === '/access-management/permission' ? 'active' : '' }}">
            <a href="{{ route('permission.index') }}">Permission</a>
          </li>
        </ul>
      </li>
      
    </ul>
  <!-- /.sidebar-menu -->
  </section>

  <!-- /.sidebar -->
</aside>