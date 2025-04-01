@php
    $current_route = request()->route()->getName();
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/major">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>-->
        <div class="sidebar-brand-text ">
            <!-- auth()->user()->name  -->
            welcome To <br />
            @if (Session::has('cmuitaccount'))
                {{ Session::get('userfullname') }}
            @endif

        </div>
    </a>
    <div class="text-center text-white"> {{ Session::get('positionName') }}
        <br>
        {{ Session::get('dep_name') }}
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a href="/major" class="nav-link {{ $current_route == 'dashboard' ? 'active' : 'active' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item active">
        <a href="/major/schedules" class="nav-link {{ $current_route == 'report.index' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span> จัดการตารางเรียน </span></a>
    </li>
    <li class="nav-item active">
        <a href="/major/schedules/viewall" class="nav-link {{ $current_route == 'report.index' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span> แสดงตารางเรียนรวม</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Report
    </div>


</ul>
<!-- End of Sidebar -->
