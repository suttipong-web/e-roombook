 <header id="header" class="header d-flex align-items-center fixed-top">
     <div class="container-fluid container-xl position-relative d-flex align-items-center">

         <a href="/" class="logo d-flex align-items-center me-auto">
             <!-- Uncomment the line below if you also wish to use an image logo -->
             <img src="{{ asset('theme_1/img/engineering_CMU_Logo_02.png') }}" alt="" style="height: 36px;">
             {{-- <h1 class="sitename">Arsha</h1> --}}
         </a>

         <nav id="navmenu" class="navmenu">
             <ul>
                 <li><a href="/#hero" class="active">หน้าแรก</a></li>
                 <li><a href="/#about">เกี่ยวกับเรา</a></li>
                 <li><a href="/#services">บริการของเรา</a></li>
                 <li><a href="/#faq-2">คำถามที่พบบ่อย</a></li>
                 <li><a href="#footer">ติดต่อเรา</a></li>
             </ul>
             <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
         </nav>

         <a class="btn-getstarted" href="/booking">เริ่มต้นจองห้อง</a>
        @if (!empty(Session::get('cmuitaccount')))
         <div class="flex-shrink-0 dropdown mx-2">
             <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle text-white "
                 data-bs-toggle="dropdown" aria-expanded="false">
                 <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-person-circle" viewBox="0 0 16 16">
                     <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                     <path fill-rule="evenodd"
                         d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                 </svg>
             </a>
             <ul class="dropdown-menu text-small shadow">
                <li class="text-center">{{  Session::get('userfullname')}}</li>
                <li><hr class="dropdown-divider"></li>
                 <li><a class="dropdown-item" href="/profile/">รายการการจอง</a></li>      
                 <li><a class="dropdown-item" href="/logout">ออกจากระบบ</a></li>
             </ul>
         </div>
         @endif
     </div>
 </header>
