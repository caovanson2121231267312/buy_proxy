@extends('layouts.app')

@section('content')
    <style>
        .table-cell-collapsed {
            max-height: 80px;
            /* chiều cao hiển thị ban đầu */
            overflow: hidden;
            /* ẩn phần dư */
            position: relative;
            transition: 0.3s;
        }

        .table-cell-collapsed::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 25px;
            /* hiệu ứng fade mờ */
            background: linear-gradient(to top, white, transparent);
        }

        .item {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item:hover {
            background: #f9fafb;
        }

        .item-info {
            flex: 1;
            min-width: 200px;
        }

        .item-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .item-desc {
            font-size: 14px;
            color: #666;
        }

        .stock {
            display: inline-block;
            margin-top: 8px;
            background: #038332;
            color: #fff;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 4px;
        }

        .item-action {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .price {
            font-weight: bold;
            color: #d63384;
            font-size: 18px;
        }

        .btn {
            background: #2196f3;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #1976d2;
        }

        .header {
            background: #006fc7;
            color: #fff;
            font-weight: bold;
            padding: 15px 20px;
            font-size: 18px;
            border-radius: 10px;
        }


        /* Responsive */
        @media (max-width: 600px) {
            .item {
                flex-direction: column;
                align-items: flex-start;
            }

            .item-action {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
    <style>
        :root {
            --primary: #6a11cb;
            --secondary: #2575fc;
            --accent: #ff6b6b;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #20bf6b;
        }


        .header-section {
            text-align: center;
            margin-bottom: 50px;
            padding: 0 20px;
        }

        .header-section h1 {
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 15px;
        }

        .header-section p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .service-card {
            transition: 0.4s;
            border-radius: 15px;
            overflow: hidden;
            border: none;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: white;
            position: relative;
            cursor: pointer;

        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .price-tag {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 15px 0;
        }

        .period {
            font-size: 1rem;
            color: #6c757d;
            font-weight: normal;
        }

        .service-icon {
            width: 70px;
            height: 70px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

        .service-icon-1 {
            width: 70px;
            height: 70px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

        .card-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 1.4rem;
        }

        .feature-list {
            list-style-type: none;
            padding: 0;
            margin-bottom: 25px;
            text-align: left;
        }

        .feature-list li {
            padding: 8px 0;
            color: #555;
            border-bottom: 1px dashed #eee;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li i {
            color: var(--success);
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .btn-service {
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

        .btn-service:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.4);
            background: linear-gradient(to right, var(--secondary), var(--primary));
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: white;
            padding: 5px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            z-index: 10;
        }

        .rating {
            color: #ffc107;
            margin: 10px 0;
        }

        @media (max-width: 768px) {
            .price-tag {
                font-size: 1.5rem;
            }

            .service-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Trang chủ</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Trang chủ</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>


    <section class="content">
        <div class="container-fluid px-4">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-3 col-6">
                    <!--begin::Small Box Widget 1-->
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $count_order }}</h3>

                            <p>Đơn hàng</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                            </path>
                        </svg>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                    <!--begin::Small Box Widget 2-->
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ number_format($count_trans, 0, ',', '.') . ' ₫' }}</h3>

                            <p>Số dư</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                            </path>
                        </svg>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                    <!--begin::Small Box Widget 3-->
                    <div class="small-box text-bg-warning">
                        <div class="inner text-white">
                            <h3>{{ number_format(Auth::user()->price, 0, ',', '.') . ' ₫' }}</h3>

                            <p>Tổng nạp</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                            </path>
                        </svg>
                        <a href="#"
                            class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 3-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                    <!--begin::Small Box Widget 4-->
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $count_order }}</h3>

                            <p>Proxy còn thời hạn</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                            </path>
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                            </path>
                        </svg>
                        <a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 4-->
                </div>
                <!--end::Col-->
            </div>


        </div>
    </section>

    @if (!empty($data_c2['note_1']) || !empty($data_c2['note_2']))
        <section class="content">
            <div class="container-fluid mt-4 px-4">

                <div class="card card-primary card-outline mb-3 mt-3">
                    <div class="card-body">
                        {!! $data_c2['note_1'] !!}

                        {!! $data_c2['note_2'] !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php
    function randomString($length = 9) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
    function render($item)
    {
        $html = '';
        if (in_array($item->proxy_type, ['RAND_COUNTRY_ROTATING', 'EU_ROTATING', 'US_4G_ROTATING', 'VN_VIETTEL_ROTATING', 'VN_VNPT_ROTATING', 'VN_FPT_ROTATING', 'VN_ISPDC_ROTATING', 'US_ROTATING', 'US_STATIC_RESIDENTIAL', 'US_V6_ROTATING', 'VN_V6_ROTATING', 'VN_MOBILE_4G_VINA_ROTATING', 'VN_ROTATING', 'VN_STATIC_PRIVATE', 'VN_STATIC_RESIDENTIAL', 'VN_VIP_PROVIDER_ROTATING'])) {
            $html .= '📅 Gói ' . $item->expiry_time . ' ngày - ' . number_format($item->price, 0, ',', '.') . 'đ';
        }

        return $html;
    }
    ?>
    <section class="content">
        <div class="container mt-5 mb-5">
            @foreach ($arr as $key => $value)
                <a href="{{ route('proxy.show', ['proxy_type' => $value['name']->proxy_type]) }}">
                    <div class="header mt-4 mb-4">{{ $value['name']->proxy_type_name }}</div>
                </a>
                <div class="my-3 ">
                    <div class="row justify-content-center">
                        @foreach ($value['data'] as $key1 => $item)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card service-card h-100">
                                    <span class="discount-badge">HOT</span>
                                    <div class="card-body text-center p-4">

                                        @if (str_contains($item[0]->package_name, 'USA'))
                                            <div class="service-icon-1">
                                                <img class="w-100" src="{{ asset('assets/559553.png') }}" alt="">
                                            </div>
                                        @elseif (str_contains($item[0]->package_name, 'EU') || str_contains($item[0]->package_name, 'Quốc gia'))
                                            <div class="service-icon-1">
                                                <img class="w-100" src="{{ asset('assets/images.png') }}" alt="">
                                            </div>
                                        @else
                                            <div class="service-icon-1">
                                                <img class="w-100"
                                                    src="{{ asset('assets/istockphoto-864417828-612x612.jpg') }}"
                                                    alt="">
                                            </div>
                                        @endif

                                        <h4 class="fw-bold">
                                            {{ $item[0]->package_name }}
                                        </h4>
                                        <div></div>
                                        <div class="">
                                            <div>
                                                <div class="price-tag">Chọn gói dịch vụ</div>
                                                <select name="package_id" class="form-select">
                                                    @foreach ($item as $item_v)
                                                        <option value="{{ $item_v->id }}"
                                                            data-price="{{ $item_v->price }}">
                                                            {{ render($item_v) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <ul class="feature-list mt-4">
                                            <li><i class="fas fa-check-circle"></i> Hỗ trợ API</li>
                                            <li><i class="fas fa-check-circle"></i> Giao thức HTTP/HTTPS</li>
                                            <li><i class="fas fa-check-circle"></i> Băng thông Không giới hạn</li>
                                            <li><i class="fas fa-check-circle"></i> Hỗ trợ 24/7</li>
                                            <li><i class="fas fa-check-circle"></i> IP Dân cư đa dạng: Đủ các dải IP mà
                                                hiện tại các
                                                nhà mạng cung cấp</li>
                                            <li><i class="fas fa-check-circle"></i> Được phép đổi IP sau
                                                {{ $key1 }} giây</li>
                                        </ul>

                                        <a href="#" class="btn btn-primary btn-service" data-type="select">
                                            Đăng ký ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- @endforeach --}}
                    </div>
                </div>
            @endforeach


            @foreach ($data_2 as $key => $value)
                <a href="{{ route('proxy.show', ['proxy_type' => $value[0]->proxy_type]) }}">
                    <div class="header mt-4 mb-4">{{ $value[0]->proxy_type_name }}</div>
                </a>
                <div class="my-3 ">
                    <div class="row justify-content-center">
                        @foreach ($value as $key1 => $item)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card service-card h-100">
                                    <span class="discount-badge">HOT</span>
                                    <div class="card-body text-center p-4">

                                        @if (str_contains($item->package_name, 'USA'))
                                            <div class="service-icon-1">
                                                <img class="w-100" src="{{ asset('assets/559553.png') }}"
                                                    alt="">
                                            </div>
                                        @elseif (str_contains($item->package_name, 'EU') || str_contains($item->package_name, 'Quốc gia'))
                                            <div class="service-icon-1">
                                                <img class="w-100" src="{{ asset('assets/images.png') }}"
                                                    alt="">
                                            </div>
                                        @else
                                            <div class="service-icon-1">
                                                <img class="w-100"
                                                    src="{{ asset('assets/istockphoto-864417828-612x612.jpg') }}"
                                                    alt="">
                                            </div>
                                        @endif

                                        <h4 class="fw-bold">
                                            {{ $item->package_name }}
                                        </h4>
                                        <div></div>
                                        <div class="">
                                            <div>
                                                {{-- <div class="price-tag">Chọn gói dịch vụ</div> --}}
                                                <div class="price-tag">
                                                    {{number_format($item->price, 0, ',', '.') }}
                                                    đ</div>

                                                <input type="text" name="package_id" hidden data-price="{{ $item->price }}"
                                                    value="{{ $item->id }}">
                                            </div>
                                        </div>
                                        <ul class="feature-list mt-4">
                                            <li><i class="fas fa-check-circle"></i> Hỗ trợ API</li>
                                            <li><i class="fas fa-check-circle"></i> Giao thức HTTP/HTTPS</li>
                                            <li><i class="fas fa-check-circle"></i> Băng thông Không giới hạn</li>
                                            <li><i class="fas fa-check-circle"></i> Hỗ trợ 24/7</li>
                                            <li><i class="fas fa-check-circle"></i> IP Dân cư đa dạng: Đủ các dải IP mà
                                                hiện tại các
                                                nhà mạng cung cấp</li>
                                        </ul>

                                        <a href="#" class="btn btn-primary btn-service" data-type="input">
                                            Đăng ký ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- <section class="content">
        <div class="container-fluid mt-4 px-4">
            @foreach ($arr as $key => $value)
                <div class="header">{{ $value['name']->proxy_type_name }}</div>
                @foreach ($value['data'] as $key1 => $item)
                    <div class="item">
                        <div class="item-info">
                            <div class="item-title">{{ $item[0]->package_name }}</div>
                            <div class="item-desc">Được phép đổi IP sau {{ $key1 }} giây</div>
                            <span class="stock">Trạng thái: hoạt động</span>
                        </div>
                        <div class="item-action">
                            <span class="price">
                                <select name="package_id" class="form-select">
                                    @foreach ($item as $item_v)
                                        <option value="{{ $item_v->id }}" data-price="{{ $item_v->price }}">
                                            {{ render($item_v) }}
                                        </option>
                                    @endforeach
                                </select>
                            </span>
                            <button class="btn btn-service" data-type="select">MUA NGAY</button>
                        </div>
                    </div>
                @endforeach
                @if ($key != 0)
                    <div class="mb-5"></div>
                    <br>
                @endif
            @endforeach
        </div>
    </section> --}}
    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('order.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Mua gói dịch vụ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="package_id" id="modal_package_id">
                        <input type="hidden" name="unit_price" id="modal_unit_price">

                        <div class="mb-3">
                            <label class="form-label">Gói đã chọn</label>
                            <input type="text" id="modal_package_name" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" id="quantity_type">Số lượng</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1"
                                min="1">
                        </div>

                        <div class="mb-3" id="dayOfUse">
                            <label class="form-label">Số ngày dùng</label>
                            <input type="number" name="dayOfUse" class="form-control" value="1"
                                min="1">
                        </div>

                        <div class="mb-3" id="auth_type">
                            <label class="form-label">Bảo mật proxy</label>
                            <div>
                                <input type="radio" name="auth_type" value="ip" id="auth_ip" checked>
                                <label for="auth_ip">Xác thực bằng IP</label>
                                &nbsp;&nbsp;
                                <input type="radio" name="auth_type" value="userpass" id="auth_userpass">
                                <label for="auth_userpass">Xác thực bằng Username/Password</label>
                            </div>
                        </div>

                        <div class="mb-3" id="ip_section">
                            <label class="form-label">Địa chỉ IP</label>
                            <input type="text" name="ip_address" id="ip_address" class="form-control"
                                value="{{ request()->ip() }}">
                        </div>

                        <div id="userpass_section" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="{{ auth()->user()->name }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" value="{{ randomString(9) }}" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="auto_renew" name="auto_renew">
                            <label class="form-check-label" for="auto_renew">Tự động gia hạn</label>
                        </div>

                        <!-- Bảng giá -->
                        <div class="border rounded p-3 bg-light">
                            <div class="d-flex justify-content-between">
                                <span>Đơn giá:</span>
                                <span id="unit_price_text">0</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Chiết khấu:</span>
                                <span id="discount">0%</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Tổng tiền:</span>
                                <span id="total_price">0</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Xác nhận mua</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-payload").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    let target = document.getElementById(this.dataset.target);
                    target.classList.toggle("table-cell-collapsed");

                    if (target.classList.contains("table-cell-collapsed")) {
                        this.textContent = "Xem thêm";
                    } else {
                        this.textContent = "Thu gọn";
                    }
                });
            });
        });
    </script>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Ẩn hiện auth type
            let authIp = document.getElementById("auth_ip");
            let authUserpass = document.getElementById("auth_userpass");
            let ipSection = document.getElementById("ip_section");
            let userpassSection = document.getElementById("userpass_section");
            let auth_type = document.getElementById("auth_type");
            let dayOfUse = document.getElementById("dayOfUse");

            document.querySelectorAll(".btn-service").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    // console.log(123)

                    let parentCard = this.closest(".card-body");
                    let packageId, packageName, price;

                    if (this.getAttribute("data-type") === "select") {
                        let select = parentCard.querySelector(
                            "select[name='package_id']");
                        let selectedOption = select.options[select.selectedIndex];
                        packageId = selectedOption.value;
                        packageName = selectedOption.text;
                        price = selectedOption.getAttribute("data-price");
                        // document.getElementById("quantity_type").innerText = "Số lượng"
                        auth_type.style.display = "block";
                        ipSection.style.display = "block";
                        dayOfUse.style.display = "none";
                    } else {
                        let input = parentCard.querySelector(
                            "input[name='package_id']");
                        packageId = input.value;
                        packageName = parentCard.querySelector(".price-tag").innerText;
                        price = input.getAttribute("data-price") || input
                            .value; // cần gắn thêm data-price khi render input
                            console.log(price)
                        // document.getElementById("quantity_type").innerText = "Số ngày sử dụng"

                        ipSection.style.display = "none";
                        userpassSection.style.display = "block";
                        auth_type.style.display = "none";
                        dayOfUse.style.display = "block";
                    }

                    // Gán vào modal
                    document.getElementById("modal_package_id").value = packageId;
                    document.getElementById("modal_package_name").value = packageName;
                    document.getElementById("modal_unit_price").value = price;
                    document.getElementById("unit_price_text").innerText = parseInt(
                        price).toLocaleString();

                    // Reset quantity
                    document.getElementById("quantity").value = 1;
                    calcTotal();

                    let modal = new bootstrap.Modal(document.getElementById(
                        "registerModal"));
                    modal.show();
                });
            });



            authIp.addEventListener("change", toggleAuth);
            authUserpass.addEventListener("change", toggleAuth);

            function toggleAuth() {
                if (authIp.checked) {
                    ipSection.style.display = "block";
                    userpassSection.style.display = "none";
                } else {
                    ipSection.style.display = "none";
                    userpassSection.style.display = "block";
                }
            }

            // Tính tiền
            let quantityInput = document.getElementById("quantity");
            quantityInput.addEventListener("input", calcTotal);

            function calcTotal() {
                let unitPrice = parseInt(document.getElementById("modal_unit_price").value) || 0;
                let qty = parseInt(quantityInput.value) || 1;
                let total = qty * unitPrice;
                document.getElementById("total_price").innerText = total.toLocaleString();
            }
        });
    </script>

    <button id="goTopBtn" title="Go to top">
        <i class="fa-solid fa-down-long"></i>
    </button>

    <style>
        #goTopBtn {
            display: none;
            /* Ẩn ban đầu */
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 99;
            font-size: 20px;
            border: none;
            outline: none;
            background-color: #3498db;
            color: white;
            cursor: pointer;
            padding: 12px 16px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            transform: rotateZ(180deg);
        }

        #goTopBtn:hover {
            background-color: #2980b9;
        }
    </style>
    <script>
        // Lấy nút
        let goTopBtn = document.getElementById("goTopBtn");

        // Hiện nút khi cuộn xuống 200px
        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                goTopBtn.style.display = "block";
            } else {
                goTopBtn.style.display = "none";
            }
        };

        // Khi click thì cuộn lên đầu
        goTopBtn.onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        };
    </script>
@endpush
