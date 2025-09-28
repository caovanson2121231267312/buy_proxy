@extends('layouts.app_seo')

@section('title')
    {{ $data_c1['title'] ?? '' }}
@endsection

@section('content')
    <!--==== HERO AREA START ==== -->
    {{-- @dd($data_c1) --}}

    <div class="hero2 pt-30" style="background-image: url({{ asset('seo/assets/img/bg/hero2-bg.jpg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="main-heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="800"><img
                                src="{{ asset('seo/assets/img/icons/span2.svg') }}" alt=""> Hỗ trợ khách hàng
                            24/7</span>
                        <h1 class="text-anime-style-3">Proxy Việt Nam & Quốc Tế - Tốc Độ Cao, Bảo Mật | buyproxy.vn</h1>
                        <p class="fade-right" data-aos-duration="900" data-aos="fade-right">Proxy tốc độ cao, bảo mật mạnh
                            mẽ từ BuyProxy.vn Dễ dàng mua & sử dụng ngay. Hỗ trợ khách hàng 24/7 - IP sạch, ổn định, tốc độ
                            vượt trội.</p>
                        <div class="hero2-form-area" data-aos="fade-right" data-aos-duration="800">
                            <input type="search" placeholder="Nhập gói proxy cần tìm kiếm">
                            <div class="button">
                                <button type="submit" class="btn_theme3 btn_theme_active3 mt_40 wow fadeInDown"
                                    data-wow-duration="0.8s">Search<span></span></button>
                            </div>
                            {{-- <div class="select-form">
                                <select>
                                    <option>.Com</option>
                                    <option>.In</option>
                                    <option>.Net</option>
                                    <option>.Tw</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="images animate1">
                        <img src="{{ asset('seo/assets/img/images/hero2-main-image.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="shape4 animate2">
            <img src="{{ asset('seo/assets/img/shapes/hero1-shape4.png') }}" alt="">
        </div>
    </div>

    <!--==== HERO AREA END ==== -->

    <div class="space20"></div>
    <!--==== BRANDS AREA START ==== -->


    <!--==== BRANDS AREA END ==== -->

    <div class="space100"></div>

    <!--==== ABOUT AREA START ==== -->

    <div class="about2 _relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about2-images">
                        <div class="shape-bg2">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 288 288">
                                <linearGradient id="imagewave" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop class="stop-color2" offset="0%" stop-opacity="1" />
                                    <stop class="stop-color1" offset="100%" stop-opacity="1" />
                                </linearGradient>
                                <path fill="url(#imagewave)" d="">

                                    <animate repeatCount="indefinite" attributeName="d" dur="10s"
                                        values="M37.5,186c-12.1-10.5-11.8-32.3-7.2-46.7c4.8-15,13.1-17.8,30.1-36.7C91,68.8,83.5,56.7,103.4,45
                            c22.2-13.1,51.1-9.5,69.6-1.6c18.1,7.8,15.7,15.3,43.3,33.2c28.8,18.8,37.2,14.3,46.7,27.9c15.6,22.3,6.4,53.3,4.4,60.2
                            c-3.3,11.2-7.1,23.9-18.5,32c-16.3,11.5-29.5,0.7-48.6,11c-16.2,8.7-12.6,19.7-28.2,33.2c-22.7,19.7-63.8,25.7-79.9,9.7
                            c-15.2-15.1,0.3-41.7-16.6-54.9C63,186,49.7,196.7,37.5,186z;


                            M51,171.3c-6.1-17.7-15.3-17.2-20.7-32c-8-21.9,0.7-54.6,20.7-67.1c19.5-12.3,32.8,5.5,67.7-3.4C145.2,62,145,49.9,173,43.4
                            c12-2.8,41.4-9.6,60.2,6.6c19,16.4,16.7,47.5,16,57.7c-1.7,22.8-10.3,25.5-9.4,46.4c1,22.5,11.2,25.8,9.1,42.6
                            c-2.2,17.6-16.3,37.5-33.5,40.8c-22,4.1-29.4-22.4-54.9-22.6c-31-0.2-40.8,39-68.3,35.7c-17.3-2-32.2-19.8-37.3-34.8
                            C48.9,198.6,57.8,191,51,171.3z;

                            M37.5,186c-12.1-10.5-11.8-32.3-7.2-46.7c4.8-15,13.1-17.8,30.1-36.7C91,68.8,83.5,56.7,103.4,45
                            c22.2-13.1,51.1-9.5,69.6-1.6c18.1,7.8,15.7,15.3,43.3,33.2c28.8,18.8,37.2,14.3,46.7,27.9c15.6,22.3,6.4,53.3,4.4,60.2
                            c-3.3,11.2-7.1,23.9-18.5,32c-16.3,11.5-29.5,0.7-48.6,11c-16.2,8.7-12.6,19.7-28.2,33.2c-22.7,19.7-63.8,25.7-79.9,9.7
                            c-15.2-15.1,0.3-41.7-16.6-54.9C63,186,49.7,196.7,37.5,186z  " />
                                </path>
                            </svg>
                        </div>
                        <div class="shape-bg1">
                            <img src="{{ asset('seo/assets/img/shapes/about2-shape.png') }}" alt="">
                        </div>
                        <div class="main-image animate1 reveal overflow-hidden">
                            <img src="{{ asset('seo/assets/img/images/about2-image.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading2 ml-40 sm:ml-0 md:ml-0">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="800"><img
                                src="{{ asset('seo/assets/img/icons/span2.svg') }}" alt="">Về chúng tôi</span>
                        <h2 class="text-anime-style-3">Về chúng tôi</h2>
                        <p data-aos="fade-left" data-aos-duration="900" class="mt-16">BuyProxy.vn là nơi cung cấp Proxy
                            Việt Nam & Quốc Tế tốc độ cao, bảo mật mạnh mẽ, phù hợp cho lướt web, quản lý tài khoản,
                            marketing, nghiên cứu dữ liệu và nhiều nhu cầu khác. Với hệ thống IP sạch, ổn định, băng thông
                            mạnh, khách hàng luôn có trải nghiệm nhanh chóng, an toàn và riêng tư tuyệt đối. Chỉ vài thao
                            tác đơn giản là bạn có thể mua và sử dụng ngay, không phức tạp. BuyProxy.vn cam kết hỗ trợ kỹ
                            thuật 24/7, dịch vụ uy tín, giá cả cạnh tranh và chất lượng vượt trội, giúp bạn yên tâm sử dụng
                            cho công việc và giải trí dài lâu..</p>

                        <div class="circle-progress-area1" data-aos="fade-left" data-aos-duration="1100">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="progresbar">
                                        <div class="progressbar">
                                            <div class="circle" data-percent="96">

                                                <div class="progress-number">96%</div>
                                            </div>
                                        </div>
                                        <p>Không giới hạn băng thông</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="progresbar">
                                        <div class="progressbar">
                                            <div class="circle two" data-percent="94">
                                                <div class="progress-number">94%</div>
                                            </div>
                                        </div>
                                        <p>Không giới hạn đổi IP</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="progresbar">
                                        <div class="progressbar">
                                            <div class="circle three" data-percent="90">
                                                <div class="progress-number">90%</div>
                                            </div>
                                        </div>
                                        <p>Giá rẻ so với thị trường</p>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                </div>

                            </div>
                        </div>

                        <div class="button mt-10" data-aos-duration="800" data-aos="fade-left">
                            <a href="hosting.html" class="btn_theme5 btn_theme_active5 mt_40 wow fadeInDown"
                                data-wow-duration="0.8s">Đăng ký ngay <span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="service2 sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="heading2">
                        <h2 class="text-anime-style-3">Tại Sao nên chọn chúng tôi?</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="800">
                    <div class="service2-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('seo/assets/img/icons/service2-icon1.svg') }}" alt="">
                        </div>
                        <div class="content heading2 mt-20">
                            <h3><a href="service-details1.html">Hỗ trợ đa nền tảng</a></h3>
                            <p class="mt-16">Bạn có thể sử dụng proxy cho các nền tảng trên desktop, android, IOS hoặc
                                tích hợp API vào các ứng dụng,...</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000">
                    <div class="service2-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('seo/assets/img/icons/service2-icon2.svg') }}" alt="">
                        </div>
                        <div class="content heading2 mt-20">
                            <h3><a href="service-details1.html">Bảo mật thông tin</a></h3>
                            <p class="mt-16">Proxy giúp bạn ẩn địa chỉ IP thực của máy, đảm bảo tính riêng tư khi duyệt
                                web.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1200">
                    <div class="service2-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('seo/assets/img/icons/service2-icon3.svg') }}" alt="">
                        </div>
                        <div class="content heading2 mt-20">
                            <h3><a href="service-details1.html">Truy cập đa dạng</a></h3>
                            <p class="mt-16">Băng thông không giới hạn giúp bạn truy cập thoải mái không cần phải suy nghĩ
                                về chi phí.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="900">
                    <div class="service2-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('seo/assets/img/icons/service2-icon4.svg') }}" alt="">
                        </div>
                        <div class="content heading2 mt-20">
                            <h3><a href="service-details1.html">Hỗ trợ nhanh chóng</a></h3>
                            <p class="mt-16">Đội ngũ nhân viên / kỹ thuật hỗ trợ nhanh chóng, kịp thời. Hoạt động liên tục
                                24/7.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1100">
                    <div class="service2-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('seo/assets/img/icons/service2-icon5.svg') }}" alt="">
                        </div>
                        <div class="content heading2 mt-20">
                            <h3><a href="service-details1.html">Tích hợp dễ dàng</a></h3>
                            <p class="mt-16">Tài liệu tích hợp dễ dàng, nhanh gọn thông qua API/ tool hỗ trợ / extension.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1300">
                    <div class="service2-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('seo/assets/img/icons/service2-icon6.svg') }}" alt="">
                        </div>
                        <div class="content heading2 mt-20">
                            <h3><a href="service-details1.html">Tiết kiệm chi phí</a></h3>
                            <p class="mt-16">Dịch vụ Proxy giúp bạn tiết kiệm chi phí so với việc mua các giải pháp bảo
                                mật đắt tiền khác.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="pricing1 sp" id="dich-vu-proxy">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="800"><img
                                src="{{ asset('seo/assets/img/icons/span2.svg') }}" alt=""> bảng giá</span>
                        <h2 class="text-anime-style-3">Các gói dịch vụ</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                @foreach ($data as $value)
                    @foreach ($value as $key2 => $item)
                        <div class="col-lg-4 col-md-6" data-aos-duration="900" data-aos="fade-up">
                            <div class="pricing1-box">
                                <div class="price-area d-none">
                                    <div class="text">
                                        <span
                                            class="text-white">{{ number_format($item[0]->price, 0, ',', '.') . ' ₫' }}</span>
                                        <span>/ngày</span>
                                    </div>
                                    <img src="{{ asset('seo/assets/img/bg/price1-box.png') }}" alt=""
                                        class="bg-shape">
                                </div>
                                <div class="pricing-content">
                                    <p class="text-center mb-2">{{ $item[0]->proxy_type_name }}</p>
                                    <h5>{{ $item[0]->package_name }}</h5>
                                    <p class="text-danger mt-2 fs-3">
                                        {{ number_format($item[0]->price, 0, ',', '.') }}/ngày
                                    </p>
                                    <div class="pricing-list">
                                        <ul>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span>
                                                Băng thông Không giới hạn
                                            </li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span>
                                                Hỗ trợ API</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Giao thức
                                                HTTP/HTTPS</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Được phép
                                                đổi IP sau {{ $key2 }} giây</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span>
                                                IP Proxy có thể gia hạn sử dụng lâu dài</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span>
                                                Mua gói thời gian càng cao thì sẽ càng rẻ</li>
                                        </ul>
                                    </div>
                                    <div class="button">
                                        <a href="https://buyproxy.vn/dashboard">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>

    <!--==== PRICING AREA END ==== -->

    <!--===== TESTIMONIAL AREA START =======-->

    <div class="tes2 sp bg-cover" style="background-image: url({{ asset('seo/assets/img/bg/tes2-bg.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="800"><img
                                src="{{ asset('seo/assets/img/icons/span2.svg') }}" alt=""> testimonials</span>
                        <h2 class="text-anime-style-3">Real Feedback From Real Users</h2>
                    </div>
                </div>
            </div>
            <div class="space60"></div>
            <div class="row">
                <div class="col-lg-10 m-auto">

                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="main-image" data-aos="fade-up" data-aos-duration="700">
                                <img src="{{ asset('seo/assets/img/testimonial/tes2-main-image.png') }}" alt="">
                            </div>
                        </div>

                        <div class="col-lg-7">

                            <div class="tes2-all" data-aos="fade-up" data-aos-duration="900">
                                <div class="tes2-slider">

                                    <div class="swiper-slide">
                                        <div class="testimonials-box-2">
                                            <div class="star">
                                                <ul>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">
                                                "We've integrated the POS software with our online store, and it's
                                                made managing both so much easier. The synchronization between our
                                                physical and online inventory is seamless, & the centralized data
                                                helps”
                                            </p>
                                            <div class="bottom">
                                                <div class="info">
                                                    <div class="image">
                                                        <img src="{{ asset('seo/assets/img/testimonial/tes2-smoll-image.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="name"><a href="#">Thomas Muller</a>
                                                        </h6>
                                                        <p class="position">Amazon Market</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="testimonials-box-2">
                                            <div class="star">
                                                <ul>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">
                                                "We've integrated the POS software with our online store, and it's
                                                made managing both so much easier. The synchronization between our
                                                physical and online inventory is seamless, & the centralized data
                                                helps”
                                            </p>
                                            <div class="bottom">
                                                <div class="info">
                                                    <div class="image">
                                                        <img src="{{ asset('seo/assets/img/testimonial/tes2-smoll-image.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="name"><a href="#">Thomas Muller</a>
                                                        </h6>
                                                        <p class="position">Amazon Market</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="pagination-buttons">
                                    <div class="tes2-prev-arrow">
                                        <button><i class="fa-solid fa-angle-up"></i></button>
                                    </div>
                                    <div class="tes2-next-arrow">
                                        <button><i class="fa-solid fa-angle-down"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--===== TESTIMONIAL AREA END =======-->

    <!--===== BLOG AREA START =======-->

    <div class="blog2 sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="800"><img
                                src="{{ asset('seo/assets/img/icons/span2.svg') }}" alt=""> our blog</span>
                        <h2 class="text-anime-style-3">Our Latest Blog & News</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="800">
                    <div class="vl-blog-2-item mt-30">
                        <div class="vl-blog-2-thumb image-anime _relative">
                            <img class="w-full" src="{{ asset('seo/assets/img/blog/blog2-image1.png') }}"
                                alt="">
                        </div>
                        <div class="vl-blog-2-content heading2">
                            <div class="vl-blog2-meta">
                                <a href="#" class="mb-16"><img
                                        src="{{ asset('seo/assets/img/icons/date1.svg') }}" alt=""> 8
                                    December 2025</a>
                            </div>
                            <h4><a href="blog-details.html">Top 5 Plugins to A Enhance Your WordPress Hosting
                                    Experience</a></h4>
                            <a href="blog-details.html" class="learn_btn mt-16">Read more <span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000">
                    <div class="vl-blog-2-item mt-30">
                        <div class="vl-blog-2-thumb image-anime _relative">
                            <img class="w-full" src="{{ asset('seo/assets/img/blog/blog2-image2.png') }}"
                                alt="">
                        </div>
                        <div class="vl-blog-2-content heading2">
                            <div class="vl-blog2-meta">
                                <a href="#" class="mb-16"><img
                                        src="{{ asset('seo/assets/img/icons/date1.svg') }}" alt=""> 5
                                    August 2025</a>
                            </div>
                            <h4><a href="blog-details.html">The Importance of Regular To Backups Your WordPress
                                    Site</a></h4>
                            <a href="blog-details.html" class="learn_btn mt-16">Read more <span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1200">
                    <div class="vl-blog-2-item mt-30">
                        <div class="vl-blog-2-thumb image-anime _relative">
                            <img class="w-full" src="{{ asset('seo/assets/img/blog/blog2-image3.png') }}"
                                alt="">
                        </div>
                        <div class="vl-blog-2-content heading2">
                            <div class="vl-blog2-meta">
                                <a href="#" class="mb-16"><img
                                        src="{{ asset('seo/assets/img/icons/date1.svg') }}" alt="">
                                    15 August 2025</a>
                            </div>
                            <h4><a href="blog-details.html">Different Types of WordPress Hosting: Shared vs
                                    Dedicated</a></h4>
                            <a href="blog-details.html" class="learn_btn mt-16">Read more <span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--===== BLOG AREA END =======-->

    <!--==== CTA AREA START ==== -->

    <div class="cta2">
        <div class="container">
            <div class="bg-area" style="background-image: url({{ asset('seo/assets/img/bg/hero2-bg.jpg') }});">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="heading1-w">
                            <h4 class="text-white">Đăng ký ngay để không bỏ lỡ những ưu đãi hấp dẫn mới nhất từ chúng tôi.</h4>
                            <div class="cta2-form-area">
                                <form action="#" class="_relative">
                                    <input type="email" placeholder="Enter Email Address">
                                    <div class="button">
                                        <button type="submit" class="btn_theme5 btn_theme_active5 mt_40 wow fadeInDown"
                                            data-wow-duration="0.8s">Đăng ký ngay<span></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cta2-images">
                            <div class="image">
                                <img src="{{ asset('seo/assets/img/images/cta2-image.png') }}" alt="">
                            </div>
                            <div class="shape">
                                <img src="{{ asset('seo/assets/img/shapes/cta2-shape.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==== CTA AREA END ==== -->
@endsection
