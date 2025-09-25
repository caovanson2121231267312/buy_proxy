    <div class="paginacontainer">

        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>

    <!--=====progress END=======-->

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img class="main-load" src="{{ asset('seo/assets/img/logo/preloader-icon2.png') }}"
                    alt="">
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!--=====HEADER START=======-->

    <header>

        <div class="header1-top pb-16 md:pb-0 sm:pb-0 d-none d-lg-block">

            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header-top-contact">
                            <div class="icon">
                                <img src="{{ asset('seo/assets/img/icons/header1-top-icon1.svg') }}" alt="">
                            </div>
                            <div class="text">
                                <a href="mailto:buyproxyvn@gmail.com">buyproxyvn@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="header-top-contact">
                            <div class="icon">
                                <img src="{{ asset('seo/assets/img/icons/header1-top-icon2.svg') }}" alt="">
                            </div>
                            <div class="text">
                                <p>Hệ Thống Cung Cấp Proxy Xoay Không Giới Hạn Băng Thông</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="header-top2-contacts">
                            <div class="header-top-contact">
                                <div class="icon">
                                    <img src="{{ asset('seo/assets/img/icons/header1-top-icon3.svg') }}" alt="">
                                </div>
                                <div class="text">
                                    <a href="#">Liên hệ</a>
                                </div>
                            </div>
                            <div class="header-top-contact ml-30">
                                <div class="icon">
                                    <img src="{{ asset('seo/assets/img/icons/header1-top-icon4.svg') }}" alt="">
                                </div>
                                <div class="text">
                                    <a href="{{ route('login') }}">Đăng nhập</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="vl-header-sticky" class="vl-header-area2 header-tranperent">
            <div class="container header1-bg">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="vl-logo">
                            <a href="{{ route('home_index') }}"  class="header1-logo-block"><img
                                    src="/storage/{{ $data_c1['logo'] }}" alt="BUYPROXY - Hệ Thống Cung Cấp Proxy Xoay Không Giới Hạn Băng Thông"></a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block text-end">
                        <div class="vl-main-menu">
                            <nav class="vl-mobile-menu-active">
                                <ul>
                                    <li><a href="{{ route('home_index') }}">Trang chủ</a></li>
                                    <li><a href="{{ route('home') }}/#dich-vu-proxy">Dịch vụ</a></li>
                                    <li><a href="{{ route('user.token') }}">Tích hợp API</a></li>
                                    <li><a href="{{ route('blog') }}">Tin tức & hướng dẫn</a></li>
                                    <li><a href="{{ route('lien_he') }}">Liên hệ</a></li>
                                    <li><a class="my-login" href="{{ route('login') }}">Đăng nhập</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="vl-header-btn text-end d-none d-lg-block">
                            <a href="{{ route('register') }}" class="btn_theme3 btn_theme_active3 mt_40 wow fadeInDown"
                                data-wow-duration="0.8s">Đăng ký ngay<span></span></a>
                        </div>
                        <div class="vl-header-action-item d-block d-lg-none">
                            <button type="button" class="vl-offcanvas-toggle">
                                <i class="fa-duotone fa-solid fa-bars-staggered"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--=====HEADER END =======-->

    <!--===== MOBILE HEADER STARTS =======-->
    <div class="vl-offcanvas vl-header-area1">
        <div class="vl-offcanvas-wrapper">
            <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
                <div class="vl-offcanvas-logo">
                    <a href="index.html" class="header1-logo-block"><img
                            src="{{ asset('seo/assets/img/logo/header-logo1.png') }}" alt=""></a>
                </div>
                <div class="vl-offcanvas-close">
                    <button class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <div class="vl-offcanvas-menu d-lg-none mb-40">
                <nav></nav>
            </div>

            <div class="space20"></div>
            <div class="vl-offcanvas-info">
                <h4 class="black1 text-24 mb-30 leading-24 font-semibold">Liên hệ chúng tôi</h4>
                <div class="single-contact flex align-items-center">
                    <div class="text">
                        <a href="tel:+11234567890"
                            class="ml-10 gray2 inline-block p-10-0 text-18 leading-18 text _hover1 font-medium">+1 123
                            456 7890</a>
                    </div>
                </div>

                <div class="single-contact flex align-items-center mt-6">
                    <div class="text">
                        <a href="mailto:buyproxyvn@gmail.com"
                            class="ml-10 gray2 inline-block p-10-0 text-18 leading-18 text _hover1 font-medium">buyproxyvn@gmail.com</a>
                    </div>
                </div>

                <div class="single-contact flex align-items-center mt-6">
                    <div class="text">
                        <a href="#"
                            class="ml-10 gray2 inline-block p-10-0 text-18 leading-18 text _hover1 font-medium">+1 123
                            456 7890</a>
                    </div>
                </div>
            </div>
            <div class="space20"></div>
            <div class="vl-offcanvas-social">
                <h4 class="black1 text-24 mb-20 mt-20 leading-24 font-semibold">Theo dõi</h4>
                <div class="vl-copyright-social2 text-start mt-20">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>

        </div>
    </div>
    <div class="vl-offcanvas-overlay"></div>
    <!--===== MOBILE HEADER STARTS =======-->


    <style>
        .my-login {
  display: none!important; /* Ẩn mặc định */
}

@media (max-width: 600px) {
  .my-login {
    display: block!important; /* Hiện khi màn hình ≤ 500px */
  }
}
    </style>
