@php
    $current_route = request()->route()->getName();
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <!-- auth()->user()->name  -->
            welcome To <br />
            @if (Session::has('cmuitaccount'))
                {{ Session::get('userfullname') }}
            @endif

        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a href="{{ route('dashboard') }}" class="nav-link {{ $current_route == 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User Management
    </div>

    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ $current_route == 'users.index' ? 'active' : '' }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Users</span></a>
    </li>


</ul>
<!-- End of Sidebar -->
