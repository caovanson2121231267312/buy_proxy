@extends('layouts.app_seo')

@section('title')
    Liên hệ chúng tôi
@endsection

@section('content')
    <div class="inner-hero1 pt-60" style="background-image: url({{ asset('seo/assets/img/bg/inner-hero1-bg.jpg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="main-heading1">
                        <h1>Liên hệ</h1>
                        <div class="breadcrumbs-pages">
                            <ul>
                                <li><a href="{{ route('home_index') }}">Trang chủ</a></li>
                                <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                <li>Liên hệ chúng tôi</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="images">
                        <img src="{{ asset('seo/assets/img/images/inner-hero-image1.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="sec-shape">
            <img src="{{ asset('seo/assets/img/shapes/inner-hero-shape.png') }}" alt="">
        </div>
    </div>

    <div class="contact-page-sec sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="heading1 text-center">
                        <span class="sub-title">Our Support</span>
                        <h2>Liên hệ chúng tôi để được hỗ trợ</h2>
                    </div>
                    <div class="contact-page-boxs">
                        <div class="row mt-20">
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-sec-single-bx">
                                    <div class="icon">
                                        <img src="{{ asset('seo/assets/img/icons/contact-page-icon1.svg') }}" alt="">
                                    </div>
                                    <div class="heading">
                                        <h4>Email</h4>
                                        <a href="mailto:{{ $data_c1['email'] }}">{{ $data_c1['email'] }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="contact-sec-single-bx">
                                    <div class="icon">
                                        <img src="{{ asset('seo/assets/img/icons/contact-page-icon2.svg') }}" alt="">
                                    </div>
                                    <div class="heading">
                                        <h4>Hotline</h4>
                                        <a href="tel:+{{ $data_c1['phone'] }}">+{{ $data_c1['phone'] }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="contact-sec-single-bx">
                                    <div class="icon">
                                        <img src="{{ asset('seo/assets/img/icons/contact-page-icon3.svg') }}" alt="">
                                    </div>
                                    <div class="heading">
                                        <h4>Thời gian làm việc</h4>
                                        <a href="#">Thứ 2 đến chủ nhật: 8 AM – 12 PM</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="images">
                        <div class="image">
                            <img src="{{ asset('seo/assets/img/images/about-page-sec1.png') }}" alt="">
                        </div>
                        <div class="shape">
                            <img src="{{ asset('seo/assets/img/shapes/tes1-shape.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="details-contact-form mt-60">
                        <div class="form-area">
                            <h4>Gửi tin nhắn cho chúng tôi hỗ trợ</h4>
                            <form action="{{ route('submit_lien_he') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="name" placeholder="Họ tên">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="phone" placeholder="Số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="title" placeholder="Tiêu đề">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <textarea rows="4" name="content" placeholder="Nội dung"></textarea>
                                        </div>
                                        <div class="button">
                                            <button type="submit" class="theme-btn1 btn_theme_active1 mt_40 wow fadeInDown"
                                                data-wow-duration="0.8s">Gửi<span
                                                    style="top: -26.1982px; left: 44.5px;"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space100"></div>
@endsection
