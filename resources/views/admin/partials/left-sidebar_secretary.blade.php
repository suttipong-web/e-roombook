@php
    $current_route = request()->route()->getName();
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
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
    <div class="text-center text-white"> {{ Session::get('positionName2') }}</div>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a href="/admin/secretary" class="nav-link {{ $current_route == 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Report
    </div>
    <li class="nav-item active">
        <a href="{{ url('/admin/report/') }}" class="nav-link {{ $current_route == 'report.index' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span>รายงาน </span></a>
    </li>
</ul>
<!-- End of Sidebar -->
