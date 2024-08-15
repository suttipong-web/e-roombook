<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ระบบจองห้องคณะวิศวกรรมศาสตร์</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('theme_1/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('theme_1/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('theme_1/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('theme_1/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('theme_1/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style type="text/css">
        .main-header {
            background-image: linear-gradient(to right top, #0097b2, #00acb3, #00bea3, #24ce82, #7ed957);
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('theme_1/img/engineering_CMU_Logo_02.png') }}" alt="" style="height: 36px;">
                {{-- <h1 class="sitename">Arsha</h1> --}}
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">หน้าแรก</a></li>
                    <li><a href="#about">เกี่ยวกับเรา</a></li>
                    <li><a href="#services">บริการของเรา</a></li>
                    <li><a href="#faq-2">คำถามที่พบบ่อย</a></li>
                    <li><a href="#footer">ติดต่อเรา</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="/booking">เริ่มต้นจองห้อง</a>

        </div>
    </header>

    <main class="main ">
        <div class=" main-header w-100" data-aos="zoom-in">
            <div class="row">
                <div style="min-height:120px;margin-top:15px;">
                    <img src="{{ asset('theme_1/img/banner.png') }}" style="width:100%;z-index:2;">
                    <div style="position: relative;">
                        <a href="/booking/"
                            style="position: absolute;bottom: 80px;width:98%;height: 70px;z-index: 9999;"></a>

                    </div>
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

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="{{ asset('theme_1/img/typeroom1.png') }}" height="94">
                            </div>
                            <h4><a href="" class="stretched-link">ห้องปฏิบัติการคอมพิวเตอร์</a></h4>
                            <p>ห้องปฏิบัติการคอมพิวเตอร์มีทั้งหมด 5 ห้อง
                                ใช้สำหรับการเรียนการสอน / อบรมการใช้งาน
                                วัดคุณสมบัติพนักงาน</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="{{ asset('theme_1/img/typeroom2.png') }}" height="94">
                            </div>
                            <h4><a href="" class="stretched-link">ห้องเรียน</a></h4>
                            <p>ห้องเรียนทั้วไปใช้สำหรับการเรียนการสอน

                                ในลักษณะการบรรยาย / การสอบทั้งภายใน

                                และภายนอก และการใช้งานอื่นๆน</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><img src="{{ asset('theme_1/img/typeroom3.png') }}" height="94">
                            </div>
                            <h4><a href="" class="stretched-link">ห้องประชุม</a></h4>
                            <p>
                                ห้องประชุมใช้สำหรับประชุม / อบรมและบรรยาย /

                                ศึกษาดูงาน รวมไปถึงใช้สำหรับต้อนรับ

                                แขกที่มาเยื่ยมเยือนคณะฯ
                            </p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->

        {{-- <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="{{ asset('theme_1/img/cta-bg.jpg') }}" alt="">

      <div class="container">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3>Call To Action</h3>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-xl-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section --> --}}

        {{-- <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-product">Card</li>
            <li data-filter=".filter-branding">Web</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-1.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 1</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-1.jpg') }}" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Product 1</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-2.jpg') }}" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding') }}">
              <img src="theme_1/img/masonry-portfolio/masonry-portfolio-3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Branding 1</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-3.jpg') }}" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-4.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 2</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-4.jpg') }}" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-5.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Product 2</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-5.jpg') }}" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-6.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Branding 2</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-6.jpg') }}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-7.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 3</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-7.jpg') }}" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-8.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Product 3</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-8.jpg') }}" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-9.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Branding 3</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="{{ asset('theme_1/img/masonry-portfolio/masonry-portfolio-9.jpg') }}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section --> --}}

        {{-- <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('theme_1/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('theme_1/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('theme_1/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('theme_1/img/team/team-4.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section --> --}}

        <!-- Pricing Section -->
        {{-- <section id="pricing" class="pricing section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Free Plan</h3>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <a href="#" class="buy-btn">Buy Now</a>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="pricing-item featured">
              <h3>Business Plan</h3>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <a href="#" class="buy-btn">Buy Now</a>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="pricing-item">
              <h3>Developer Plan</h3>
              <h4><sup>$</sup>49<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <a href="#" class="buy-btn">Buy Now</a>
            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>

    </section><!-- /Pricing Section --> --}}

        {{-- <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('theme_1/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('theme_1/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('theme_1/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('theme_1/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('theme_1/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section --> --}}

        <!-- Faq 2 Section -->
        <section id="faq-2" class="faq-2 section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>คำถามที่พบบ่อย</h2>
                <p>เราได้รวบรวมคำถามที่พบบ่อยไว้ให้ด้านล่างนี้ หากมีคำถามเพิ่มเติม
                    สามารถติดต่อเจ้าหน้าที่ได้ที่เบอร๋โทรศัพท์ 44120 </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10">

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

        {{-- <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-7">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Your Name</label>
                  <input type="text" name="name" id="name-field" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Message</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section --> --}}

    </main>

    <footer id="footer" class="footer">

        {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div> --}}

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">คณะวิศวกรรมศาสตร์</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>มหาวิทยาลัยเชียงใหม่ 239 ถนนห้วยแก้ว 00</p>
                        <p>ต.สุเทพ อ.เมือง จ.เชียงใหม่ 502</p>
                        <p class="mt-3"><strong>โทรศัพท์:</strong> <span>+66 5394 1300</span></p>
                        <p class="mt-3"><strong>โทรสาร:</strong> <span>+66 5321 7143</span></p>
                        <p><strong>อีเมล:</strong> <span>contacts@cmu.ac.th</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>บริการสำคัญ</h4>
                    <ul>
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
                            <a href="https://donate.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                การบริจาค
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://portal.office.com/" class="nav-link p-0 text-body-secondary">
                                CMU MAIL
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                CMU MIS
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://cmubackoffice.mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                สำหรับเจ้าหน้าที่
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
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
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>ติดตามเรา</h4>
                    <p>ติดตามเราผ่านสื่อต่างที่นี่</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">2024 Chiang Mai University,</strong>
                <span> All
                    rights reserved.</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

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
