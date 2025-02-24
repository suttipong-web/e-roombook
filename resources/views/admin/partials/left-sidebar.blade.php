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
        <h5> ระบบจัดการ </h5>
    </div>
    <li class="nav-item ">
        <a href="/admin/room" class="nav-link {{ $current_route == 'room' ? 'active' : '' }}">
            <i class="bi bi-hospital"></i>
            <span>จัดการข้อมูลห้อง</span></a>
    </li>

    <li class="nav-item ">
        <a href="/admin/dashboard" class="nav-link {{ $current_route == 'dashboard' ? 'active' : '' }}">
            <i class="bi bi-hospital"></i>
            <span>ข้อมูลการจองห้อง</span></a>
    </li>


    <li class="nav-item ">
        <a href="/admin/schedules" class="nav-link {{ $current_route == 'admin.schedule' ? 'active' : '' }}">
            <i class="bi bi-hospital"></i>
            <span>จัดการตารางเรียน</span></a>
    </li>

    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ $current_route == 'users.index' ? 'active' : '' }}">
            <i class="bi bi-person-fill-gear"></i>
            <span>จัดการผู้ใช้งาน</span></a>
    </li>

    <li class="nav-item">
        <a href="/admin/term" class="nav-link {{ $current_route == 'admin.term' ? 'active' : '' }}">
        <i class="bi bi-list-check"></i>
            <span>กำหนดการลงตารางเรียน</span></a>
    </li>

    <li class="nav-item">
        <a href="/admin/groupCourse" class="nav-link {{ $current_route == 'admin.groupCourse' ? 'active' : '' }}">
        <i class="bi bi-person-fill-gear"></i>
            <span>จัดการผู้ใช้ลงตารางเรียน</span></a>
    </li>

    
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
