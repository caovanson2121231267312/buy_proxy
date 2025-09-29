<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $data_c1['title'] ?? '')</title>
    <meta name="robots" content="noindex, nofollow">
    @if (!empty($data_c1['icon']))
        <link rel="icon" type="image/png" href="/storage/{{ $data_c1['icon'] }}" />
    @endif
    <!--=====CSS=======-->
    <link rel="stylesheet" href="{{ asset('seo/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/slick-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/utility.css') }}">
    <link rel="stylesheet" href="{{ asset('seo/assets/css/main.css') }}">


    <!--=====JQUERY=======-->
    <script src="{{ asset('seo/assets/js/jquery-3-7-1.min.js') }}"></script>
</head>

<body class="body1">
    @include('layouts.header_seo')


    <main>
        @yield('content')


    </main>

    <footer class="vl-footer-area2 bg-cover"
        style="background-image: url({{ asset('seo/assets/img/bg/noise-bg1.jpg') }});">

        <!-- footer area start -->
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="vl-footer-widget mb-50">
                            <div class="vl-footer-logo black-logo">
                                <a href="index.html"><img src="/storage/{{ $data_c1['logo'] ?? '' }}"
                                        alt=""></a>
                            </div>
                            <div class="vl-footer-text heading1 mt-16">
                                <p>Tại BuyProxy.vn, chúng tôi luôn nỗ lực mang đến cho bạn những giải pháp proxy an
                                    toàn, nhanh chóng và ổn định nhất. Hãy trải nghiệm dịch vụ ngay hôm nay để cảm nhận
                                    sự khác biệt!.</p>
                            </div>
                            <div class="vl-footer-social2 text-start mt-20">
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="vl-footer-widget2 mb-50 ml-70 md:ml-30 sm:ml-0">
                            <h4>Quick Links</h4>
                            <div class="vl-footer-list">
                                <ul>
                                    <li><a href="#">Giới thiệu</a></li>
                                    <li><a href="#">Tin tức</a></li>
                                    <li><a href="#">Dịch vụ</a></li>
                                    <li><a href="#">Tích hợp API</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="vl-footer-widget2 mb-50 ml-0 md:ml-0 sm:ml-0">
                            <h4>Useful Links</h4>
                            <div class="vl-footer-list">
                                <ul>
                                    <li><a href="#">Cloud Hosting</a></li>
                                    <li><a href="#">VPS Hosting</a></li>
                                    <li><a href="#">Shared Hosting</a></li>
                                    <li><a href="#">WP Hosting</a></li>
                                    <li><a href="#">Web Hosting</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-8 col-sm-6">
                        <div class="vl-footer-subscribe2 vl-footer-widget mb-50 ml-30 sm:ml-0 md:ml-0">
                            <h4>Newsletter</h4>
                            <div class="heading1">
                                <p>Subscribe Our Newletter</p>
                            </div>
                            <form action="#" class="_relative">
                                <input type="email" placeholder="Enter Email Address">
                                <div class="button">
                                    <button type="submit" class="btn_theme5 btn_theme_active5 mt_40 wow fadeInDown"
                                        data-wow-duration="0.8s">Subscribe<span></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer area end -->

        <!-- copy-right area start -->
        <div class="container">
            <div class="row vl-copyright1 _dv-top align-items-center">
                <div class="col-lg-6">
                    <p>Copyright 2025 buyproxy.vn</p>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
        <!-- copy-right area end -->

    </footer>

    <!-- HTML -->
<div class="contact-icons">
  <a href="{{ $data_c1['zalo'] ?? '' }}" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo">
  </a>
  <a href="{{ $data_c1['facebook'] ?? '' }}" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/2048px-2021_Facebook_icon.svg.png" alt="Facebook">
  </a>
  <a href="tel:{{ $data_c1['phone'] ?? '' }}">
    <img src="https://static.vecteezy.com/system/resources/previews/036/269/966/non_2x/phone-call-icon-answer-accept-call-icon-with-green-button-contact-us-telephone-sign-yes-button-incoming-call-icon-vector.jpg" alt="Phone">
  </a>
</div>

<!-- CSS -->
<style>
.contact-icons {
  position: fixed;
  right: 20px;
  bottom: 100px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  z-index: 9999;
}

.contact-icons a img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  box-shadow: 0 4px 8px rgba(0,0,0,0.3);
  transition: transform 0.3s, box-shadow 0.3s;
}

.contact-icons a img:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 12px rgba(0,0,0,0.5);
}
</style>

    <!--=== js === -->
    <script src="{{ asset('seo/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seo/assets/js/fontawesome.js') }}"></script>
    <script src="{{ asset('seo/assets/js/mobile-menu.js') }}"></script>
    <script src="{{ asset('seo/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('seo/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('seo/assets/js/jquery.countup.js') }}"></script>
    <script src="{{ asset('seo/assets/js/slick-slider.js') }}"></script>
    <script src="{{ asset('seo/assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('seo/assets/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('seo/assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('seo/assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('seo/assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('seo/assets/js/Splitetext.js') }}"></script>
    <script src="{{ asset('seo/assets/js/text-animation.js') }}"></script>
    <script src="{{ asset('seo/assets/js/aos.js') }}"></script>
    <script src="{{ asset('seo/assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('seo/assets/js/jaquery-ripples.js') }}"></script>
    <script src="{{ asset('seo/assets/js/jquery.lineProgressbar.js') }}"></script>
    <script src="{{ asset('seo/assets/js/animation.js') }}"></script>
    <script src="{{ asset('seo/assets/js/main.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        }


        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    

        function copyHtml(elementId) {
            let el = document.getElementById(elementId);
            let range = document.createRange();
            range.selectNode(el);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("Đã copy nội dung HTML!");
        }
    </script>


</body>

</html>
