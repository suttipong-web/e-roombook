@php
    $current_route = request()->route()->getName();
   //  $caseAdmin = (int)($getService->chkAddminRoomType($request->session()->get('cmuitaccount')));
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
            <span>Dashboard </span></a>
    </li>


        
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        <h5> จองห้อง </h5>
    </div>
    <li class="nav-item ">
        <a href="/admin/dashboard" class="nav-link {{ $current_route == 'dashboard' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span>จองห้องรายวัน (ทั่วไป)</span></a>
    </li>

    <li class="nav-item ">
        <a href="/admin/schedules" class="nav-link {{ $current_route == 'admin.schedule' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span>จอง/ลงตารางเรียน</span></a>
    </li>

    <li class="nav-item active">
        <a href="/admin/schedules/viewAll" class="nav-link {{ $current_route == 'admin.schedule.viewAll' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span> แสดงตารางเรียนรวม</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        <h5> จัดการข้อมูล </h5>
    </div>
    <li class="nav-item active">
        <a href="/admin/schedules/config" class="nav-link {{ $current_route == 'admin.schedule.config' ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span style="font-size: 12.5px"> กำหนดค่าการจองห้อง (ภาพรวม) </span></a>
    </li>
    <li class="nav-item">
        <a href="/admin/term" class="nav-link {{ $current_route == 'admin.term' ? 'active' : '' }}" >
        <i class="bi bi-list-check"></i>
            <span style="font-size: 12.5px">กำหนดช่วงลงข้อมูลตารางเรียน</span></a>
    </li>
    
    <li class="nav-item">
        <a href="/admin/groupCourse" class="nav-link {{ $current_route == 'admin.groupCourse' ? 'active' : '' }}">
        <i class="bi bi-person-fill-gear"></i>
            <span>จัดการกลุ่มผู้ใช้งาน</span></a>
    </li>
    <li class="nav-item ">
        <a href="/admin/room" class="nav-link {{ $current_route == 'room' ? 'active' : '' }}">
            <i class="bi bi-hospital"></i>
            <span>ข้อมูลห้อง</span></a>
    </li>
 
     

    <hr class="sidebar-divider">
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ $current_route == 'users.index' ? 'active' : '' }}">
            <i class="bi bi-person-fill-gear"></i>
            <span>ผู้ใช้งานทั้งหมด</span></a>
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
