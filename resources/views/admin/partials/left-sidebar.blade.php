  @php
  $current_route=request()->route()->getName();
  @endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
     <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <i style="    color: #c2c7d0;" class=" fa-2x fas fa-user-circle"></i>
         </div>
        <div class="info">
          <a href="/admin/dashboard" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

         
          <li class="nav-item {{$current_route=='customers.index'?'menu-open':''}}">
            <a href="/admin/customers" class="nav-link {{$current_route=='customers.index'?'active':''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Customers
              </p>
            </a>
           
          </li>
          <li class="nav-item {{$current_route=='orders.index'?'menu-open':''}}">
            <a href="/admin/orders" class="nav-link {{$current_route=='orders.index'?'active':''}}">
            <i class="nav-icon ion ion-bag"></i>
              <p>
              Orders
              </p>
            </a>
           
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>