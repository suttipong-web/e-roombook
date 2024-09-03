<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ระบบจองห้องคณะวิศวกรรมศาสตร์</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @includeIf('partials.headtag')

    <style type="text/css">
        .main-header {
            background-image: linear-gradient(to right top, #0097b2, #00acb3, #00bea3, #24ce82, #7ed957);
        }
    </style>
</head>

<body class="index-page">

    @includeIf('partials.header')
    <main class="main ">
        <div class=" main-header w-100" data-aos="zoom-in">
            <div class="row">
                <div style="min-height:120px;margin-top:15px;">
                    <a href="/booking/">
                        <img src="{{ asset('theme_1/img/banner2.jpg') }}" style="width:100%;z-index:2;">
                    </a>

                </div>

            </div>
        </div>

        <div style="clear: both"></div>
        <div class="container ">
            <!-- About Section -->
            <section id="about" class="about section">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>เกี่ยวกับเรา</h2>
                </div><!-- End Section Title -->
                <div class="container">
                    <div class="row gy-4 ">
                        <div class="col-lg-8 content" data-aos="fade-up" data-aos-delay="100">
                            <p> ระบบจองห้อง คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่
                                จะช่วยให้ผู้ใช้งานทุกคนสามารถเข้าถึงการใช้งานของห้องเรียน
                                ห้องปฏิบัติการคอมพิวเตอร์ รวมไปถึงห้องประชุมได้อย่างรวดเร็ว ทราบถึงสถานการณ์ใช้งาน
                                และอำนวยความสะดวกให้กับ
                                เจ้าหน้าที่ส่วนงานในการจัดการตารางการเรียนการสอนของแต่ละภาคการศึกษา
                                มากไปกว่านั้นระบบนี้
                                มาพร้อมกับฟังก์ชั่น
                                สำหรับผู้ดูแลระบบที่จะช่วยในการบริหารจัดการห้องต่างๆ ได้อย่างสะดวก รวดเร็ว
                                และมีประสิทธิภาพมากยิ่งขึ้น เป็นโซลูชั่นที่
                                ตอบโจทย์ความต้องการให้กับทุก ๆ ส่วนงาน รวมไปถึงผู้ใช้งานทั้งภายในและภายนอกคณะฯ
                            </p>
                        </div>
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <ul>
                                <li><i class="bi bi-check2-circle"></i><span>ตรวจสอบสถานะะการใช้งานได้</span>
                                </li>
                                <li><i class="bi bi-check2-circle"></i><span>เพิ่มข้อมูลตารางสอนได้อย่างง่ายดาย</span>
                                </li>
                                <li><i class="bi bi-check2-circle"></i> <span>จองใช้งานห้องได้ทุกที่ ทุกเวลา</span>
                                </li>
                                <li><i class="bi bi-check2-circle"></i> <span>แจ้งเตือนผู้ดูแลห้องได้</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </section><!-- /About Section -->

        </div>
        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>ประเภทห้อง</h2>
                <p>ระบบจองห้องคณะวิศวกรรมศาสตร์ มีประเภทห้องทั้งหมด 3 ประเภทด้วยกันดังนี้</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4 text-center justify-content-center">
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="{{ asset('theme_1/img/typeroom1-1.png') }}" height="94">
                            </div>
                            <h4><a href="/booking/1/ห้องประชุม" class="stretched-link">ห้องประชุม</a></h4>
                            <p>
                                ห้องประชุมใช้สำหรับประชุม / อบรมและบรรยาย /

                                ศึกษาดูงาน รวมไปถึงใช้สำหรับต้อนรับ

                                แขกที่มาเยื่ยมเยือนคณะฯ
                            </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="{{ asset('theme_1/img/typeroom2-2.png') }}" height="94">
                            </div>
                            <h4><a href="/booking/2/ห้องเรียน" class="stretched-link">ห้องเรียน</a></h4>
                            <p>ห้องเรียนทั้วไปใช้สำหรับการเรียนการสอน

                                ในลักษณะการบรรยาย / การสอบทั้งภายใน

                                และภายนอก และการใช้งานอื่นๆน</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="{{ asset('theme_1/img/typeroom3-3.png') }}" height="94">
                            </div>
                            <h4><a href="/booking/3/ห้องปฏิบัติการคอมพิวเตอร์"
                                    class="stretched-link">ห้องปฏิบัติการคอมพิวเตอร์</a></h4>
                            <p>ห้องปฏิบัติการคอมพิวเตอร์มีทั้งหมด 5 ห้อง
                                ใช้สำหรับการเรียนการสอน / อบรมการใช้งาน
                                วัดคุณสมบัติพนักงาน</p>
                        </div>
                    </div><!-- End Service Item -->
                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Faq 2 Section -->
        <section id="faq-2" class="faq-2 section light-background ">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>คำถามที่พบบ่อย</h2>
                <p>เราได้รวบรวมคำถามที่พบบ่อยไว้ให้ด้านล่างนี้ หากมีคำถามเพิ่มเติม
                    สามารถติดต่อเจ้าหน้าที่ได้ที่เบอร๋โทรศัพท์ 44120 </p>
            </div><!-- End Section Title -->

            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-10 ">
                        <div class="faq-container">
                            <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>ใครที่สามารถจองห้องผ่านระบบนี้ได้บ้าง ?</h3>
                                <div class="faq-content">
                                    <p>สามารถจองได้ทั้งบุคคลภายในคณะฯ และภายนอกคณะฯ
                                        สำหรับบุคคลภายนอกคณะฯสามารถจองได้เฉพาะห้องเรียนและห้องปฏิบัติการคอมพิวเตอร์เท่านั้น
                                        ไม่สามารถจองห้องประชุมได้ และอาจมีค่าใช้จ่ายในการใช้ห้อง</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->
                            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3> ต้องจองล่วงหน้ากี่วัน กี่ชั่วโมง ?</h3>
                                <div class="faq-content">
                                    <p>ผู้จองควรทำการจองใช้งานล่วงหน้า อย่างน้อย 1 วัน
                                        เพื่อความสะดวกในการปฏิบัติงานของผู้ดูแลประจำห้องนั้น ๆ
                                        สำหรับบุคคลภายนอกคณะฯ ควรทำการจองล่วงหน้าอย่างน้อย 10 วัน
                                        เพราะจำเป็นต้องใช้เวลาในการดำเนินการขออนุมัติจากผู้บริหาร</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>สามารถจองล่วงหน้า ของภาคการศึกษาถัดไปได้ไหม ?</h3>
                                <div class="faq-content">
                                    <p>สามารถจองใช้งานห้องต่าง ๆ ได้ภายในภาคการศึกษาปัจจุบันได้เท่านั้น
                                        ไม่สามารถจองใช้งานของภาคการศึกษาถัดไปได้</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>มีห้องประเภทไหนให้จองบ้าง ?</h3>
                                <div class="faq-content">
                                    <p>: มีห้องเรียน ห้องประชุม ห้องปฏิบัติการ และห้องทำงานกลุ่ม
                                        ซึ่งแต่ละประเภทมีขนาดและอุปกรณ์แตกต่างกัน</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>สามารถยกเลิการจองได้ไหม ?</h3>
                                <div class="faq-content">
                                    <p>หากการจองของท่านได้รับการอนุมัติแล้ว กรณีที่ท่านต้องการยกเลิกการจองดังกล่าว
                                        สามารถทำการยกเลิกการจองนั้น
                                        โดยการเข้าสู่ระบบของท่าน
                                        และสามารถยกเลิกการจองที่ได้รับการอนุมัติแล้วได้ด้วยตัวท่านเอง</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Faq 2 Section -->


    </main>

    @includeIf('partials.footer-bgwhite')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('theme_1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('theme_1/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('theme_1/js/main.js') }}"></script>




</body>

</html>
