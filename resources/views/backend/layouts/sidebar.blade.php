@php

use App\Models\Staff;
use App\Models\LeaveApplication;

$hasStaff = auth()->user()->hasStaff;

if ($hasStaff) {
    $subordinates = Staff::where('supervisor_id', $hasStaff->id)->get();
    $total_waiting = $leaveApplications = LeaveApplication::whereIn('staff_id', $subordinates->pluck('id'))
    ->where('status_id', 5)
    ->paginate(10);
} else {
  
}


@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('logo_fd.jpg')}}" alt="FD Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">FD HRMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(auth()->user()->hasStaff->image_path))
          <img src="{{asset('storage/'.auth()->user()->hasStaff->image_path)}}" class="img-circle elevation-2" alt="User Image" style="width: 3rem;">
          @else
          <img src="{{asset('default_picture.jpg')}}" class="img-circle elevation-2" alt="User Image" style="width: 3rem;">
          @endif
        </div>
        <div style="padding: 0 1px 0 5px; white-space: normal;" class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
          @if(!empty(auth()->user()->hasStaff->hasPosition))
          <span>{{auth()->user()->hasStaff->hasPosition->desc}}</span>
          @else
          <span></span>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route ('home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @role('Admin')
          <li class="nav-item">
            <a href="{{route ('staff.staff-list')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Staff
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endrole
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Leaves
                <i class="fas fa-angle-left right"></i>
                @if(auth()->user()->hasStaff?->is_supervisor == 1)
                @if(count($total_waiting) > 0)
                <span class="badge badge-info right">!</span>
                @endif
                @endif
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route ('leave.leave-request-form')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Request a Leave</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route ('leave.leave-application-list')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Leave Applications</p>
                </a>
              </li>
              @if(auth()->user()->hasStaff?->is_supervisor == 1)
              <li class="nav-item">
                <a href="{{route ('leave.leave-subordinates-application')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Subordinates Leave Applications</p>
                  @if(count($total_waiting) > 0)
                  <span class="right badge badge-info">{{count($total_waiting)}}</span>
                  @endif
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="{{route ('leave.leave-balance')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Leave Balance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route ('leave.leave-entitlement')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Leave Entitlement</p>
                </a>
              </li>
            </ul>
          </li>
          @role('Admin')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                User Account Control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route ('uac.role-list')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Role Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Permission Management</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole
          <li class="nav-item">
            <a href="{{route ('staff.staff-profile')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Profile
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @role('Admin|HOD')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route ('admin.announcement-list')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <p>Announcment</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole
          <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>