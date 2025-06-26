<footer id="footer" class="footer light-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about text-dark">
                <a href="index.html" class="d-flex align-items-center">
                    <span class="sitename">คณะวิศวกรรมศาสตร์</span>
                </a>
                <div class="footer-contact pt-2 text-dark" style="font-size: 14px;">
                    <div> มหาวิทยาลัยเชียงใหม่ 239 ถนนห้วยแก้ว  </div>
                    <div>ตำบลสุเทพ อำเภอเมือง จังหวัดเชียงใหม่ 50200</div>
                    <div class="mt-2"><strong>โทรศัพท์</strong></div>
                    <div > <span>ห้องประชุม (งานบริหารทั่วไป ) โทรศัพท์ 0-539-44171 </span></div>
                    <div class="mt-2"> <span>ห้องเรียนและห้องคอมพิวเจตอร์ (งานพัฒนาเทคโนโลยี ฯ) <br/>โทรศัพท์ 0-539-44120 </span></div>
                    <div class="mt-2"><strong>โทรสาร:</strong> <span>0-539-44120</span></div>
                    <div><strong>อีเมล:</strong> <span>webmaster@eng.cmu.ac.th</span></div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 footer-links text-dark">
                <h4>บริการสำคัญ</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i>
                        <a href=" /booking/listall"
                            class="nav-link p-0 text-body-secondary">
                            รายการจองห้องประชุม
                        </a>
                    </li>
               
                    <li><i class="bi bi-chevron-right"></i>
                        <a href="https://cmu.ac.th/Content/University/CMUPhoneBook.pdf"
                            class="nav-link p-0 text-body-secondary">
                            สมุดโทรศัพท์มหาวิทยาลัยเชียงใหม่
                        </a>
                    </li>
                    <li><i class="bi bi-chevron-right"></i>
                        <a href="https://cmu.ac.th/Content/University/BrochureCMU-Map2017.pdf"
                            class="nav-link p-0 text-body-secondary">
                            แผนที่มหาวิทยาลัยเชียงใหม่
                        </a>
                    </li>                
                   
                    <li><i class="bi bi-chevron-right"></i>
                        <a href="/admin/" class="nav-link p-0 text-body-secondary">
                            สำหรับผู้ดูแลระบบ/ส่วนงาน
                        </a>
                    </li>
                    <li><i class="bi bi-chevron-right"></i>
                        <?php 
                          $dates = date("Y-m-d");
                          
                          $CMUOauth_ = 'https://oauth.cmu.ac.th/v1/Authorize.aspx?response_type=code&client_id=nP2KgMxA05UV7VAq4uhQMDGN2xNfqhpjNbzZeQqM&redirect_uri=https://e-roombook.eng.cmu.ac.th/callback_booking&scope=cmuitaccount.basicinfo&state=bookingindex_1'.$dates;    
                        ?>
                        <a href="{{ $CMUOauth_ }}" class="nav-link p-0 text-body-secondary">
                            สำหรับบุคคลภายในคณะฯ
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links  text-dark">
                <h4>เยี่ยมชมมหาวิทยาลัยเชียงใหม่</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i>
                        <a href="https://cmu.ac.th/360/" class="nav-link p-0 text-body-secondary">
                            CMU 360 องศา
                        </a>
                    </li>
                </ul>
                <h4 class="mt-3">ช่องทางสื่อสาร</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i>
                        <a href="https://www.cmu.ac.th/">https://www.cmu.ac.th.</a>
                    </li>
                    <li><i class="bi bi-chevron-right  text-dark"></i>
                        <a href="https://portal.office.com/" class="nav-link p-0 text-body-secondary">
                            CMU MAIL
                        </a>
                    </li>
                    <li><i class="bi bi-chevron-right  text-dark"></i>
                        <a href="https://mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                            CMU MIS
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12  text-dark">
                <h4>ติดตามเรา</h4>
                ติดตามเราผ่านสื่อต่าง ๆ ที่นี่
                <div class="social-links d-flex">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4  text-dark">
        <div style="font-weight: 800;color: black"> © Copyright 2025: Faculty of Engineering, Chiang Mai University  </div>
        <div class="credits" style="color: #f5f6f8">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/" style="color: #f5f6f8">BootstrapMade</a>
        </div>
    </div>

</footer>
