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

        /* .btn {
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
        } */

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
                    <h3 class="mb-0">Dịch vụ của tôi</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My proxy</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
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
        <div class="container-fluid mt-4 px-4">
            <div class="card card-primary card-outline mb-3 mt-3">
                <div class="card-header" bis_skin_checked="1">
                    <div class="d-block mb-3 mt-3" bis_skin_checked="1">
                        <h4>Danh sách proxy đã mua</h4>
                    </div>
                    <div>
                        <form method="GET" action="/" class=" w-100">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <input type="text" name="search" class="form-control me-2"
                                        placeholder="Tìm kiếm ..." value="{{ request('search') }}">
                                </div>
                                <div class="col-12 col-lg-6 d-flex">
                                    {{-- <div class="dropdown">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Xuất dữ liệu
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Xuất excel</a></li>
                                            <li><a class="dropdown-item" href="#">Xuất json</a></li>
                                        </ul>
                                    </div> --}}
                                    <a href="{{ route('orders.export') }}" style="width: 180px" class="btn btn-success ms-2">Xuất file</a>
                                </div>
                                <div class="col-12 col-lg-2">


                                </div>

                            </div>


                        </form>
                    </div>
                </div>



                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    {{-- <th>User</th> --}}
                                    <th>Proxy</th>
                                    <th>SL</th>
                                    <th>Giá/1</th>
                                    <th>Tổng</th>
                                    <th>Auth</th>
                                    <th>Tài khoản đăng nhập</th>
                                    <th>Auto Renew</th>
                                    <th width="420">Thông tin đăng ký</th>
                                    <th>Mã đăng ký</th>
                                    <th>Hết hạn</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ "MD" . $order->id }}</td>
                                        {{-- <td>{{ $order->user->name ?? '-' }}</td> --}}
                                        <td>{{ $order->proxy->package_name ?? '-' }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ number_format($order->unit_price, 0, ',', '.') }} ₫</td>
                                        <td><b>{{ number_format($order->total_price, 0, ',', '.') }} ₫</b></td>
                                        <td>{{ $order->auth_type }}</td>
                                        <td>
                                            @if ($order->auth_type == 'ip')
                                                {{-- {{ $order->ip_address }} --}}
                                            @else
                                                <span class="text-primary">{{ $order->username }}</span> /
                                                <span class="text-danger">{{ $order->password }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {!! $order->auto_renew
                                                ? '<span class="badge bg-success">ON</span>'
                                                : '<span class="badge bg-secondary">OFF</span>' !!}
                                        </td>
                                        <td>
                                            {{-- @if ($order->type == 1) --}}
                                                @if (!empty($order->payload_data))
                                                    <div class="payload-box table-cell-collapsed"
                                                        id="payload-{{ $order->id }}">
                                                        @foreach ($order->payload_data as $item)
                                                            <ul style="margin:0; padding-left: 15px;">
                                                            
                                                                {{-- @if(!empty($item['proxy_type']))
                                                                    <li><b>Proxy Type:</b> {{ $item['proxy_type'] }}</li>
                                                                @endif

                                                                @if(!empty($item['package_name']))
                                                                    <li><b>Package:</b> {{ $item['package_name'] }}</li>
                                                                @endif --}}

                                                                @if(!empty($item['package_api_key']))
                                                                    <li><b>Package api key:</b> {{ $item['package_api_key'] }}</li>
                                                                @endif

                                                                {{-- @if(!empty($item['public_ip']))
                                                                    <li><b>Public IP:</b> {{ $item['public_ip'] }}</li>
                                                                @endif --}}
                                                                @if(!empty($item['prevIp']))
                                                                    <li><b>prevIp:</b> {{ $item['prevIp'] }}</li>
                                                                @endif
                                                                @if(!empty($item['domain']))
                                                                    <li><b>Domain:</b> {{ $item['domain'] }}</li>
                                                                @endif
                                                                @if(!empty($item['port']))
                                                                    <li><b>Port:</b> {{ $item['port'] }}</li>
                                                                @endif
                                                                @if(!empty($item['username']))
                                                                    <li><b>Username:</b> {{ $item['username'] }}</li>
                                                                @endif
                                                                @if(!empty($item['password']))
                                                                    <li><b>Password:</b> {{ $item['password'] }}</li>
                                                                @endif

                                                                @if(!empty($item['public_origin_ip']))
                                                                    <li><b>Public Origin IP:</b> {{ $item['public_origin_ip'] }}</li>
                                                                @endif

                                                                {{-- @if(!empty($item['http_port']))
                                                                    <li><b>Port http:</b> {{ $item['http_port'] }}</li>
                                                                @endif --}}

                                                                @if(!empty($item['https_port']))
                                                                    <li><b>Port https:</b> {{ $item['https_port'] }}</li>
                                                                @endif
                                                                {{-- 
                                                                @if(!empty($item['change_ip_time']))
                                                                    <li><b>Change IP Time:</b> {{ $item['change_ip_time'] }}</li>
                                                                @endif --}}

                                                                @if(!empty($item['proxy_auth_ip']))
                                                                    <li><b>Proxy Auth IP:</b> {{ $item['proxy_auth_ip'] }}</li>
                                                                @endif

                                                                {{-- @if(!empty($item['expired_date']))
                                                                    <li><b>Expired:</b> {{ $item['expired_date'] }}</li>
                                                                @endif

                                                                @if(isset($item['auto_renew']))
                                                                    <li><b>Gia hạn:</b> {{ $item['auto_renew'] ? 'ON' : 'OFF' }}</li>
                                                                @endif --}}
                                                            </ul>
                                                        @endforeach

                                                    </div>
                                                    <button type="button" class="btn btn-link btn-sm toggle-payload"
                                                        data-target="payload-{{ $order->id }}">
                                                        Xem thêm
                                                    </button>
                                                @endif
                                            {{-- @elseif ($order->type == 2)
                                                Đang khởi tạo
                                            @else
                                                Đang khởi tạo
                                            @endif --}}
                                        </td>
                                        <td>
                               
                                                @if (!empty($order->payload_data))
                                                    <div class=""
                                                        id="payload-{{ $order->id }}">
                                                        @foreach ($order->payload_data as $item)
                                                    
                                                        @if(!empty($item['id']))
                                                            {{ $item['id'] }}
                                                        @endif
                                                   
                                                        @endforeach
                                                @endif
                                        </td>
                                        <td>{{ $order->end_date ? $order->end_date->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            @if ($order->status == 0)
                                                <div class="text-danger">Hết hạn</div>
                                            @else
                                                <div class="text-info">Đang sử dụng</div>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#apiModal{{ $order->id }}">
                                                Gia hạn
                                            </button>
                                            <a class="btn btn-sm btn-warning" href="{{ route('xoay', ['id' =>  $order->id]) }}">
                                                Xoay proxy
                                            </a>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#apiEditModal{{ $order->id }}">
                                                Sửa
                                            </button>
                                        </td>

                                    </tr>
                                    <div class="modal " id="apiEditModal{{ $order->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('update.proxy', $order->id) }}"
                                                    class="modal-content">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Cập nhật</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Thiếp lập thời gian tự động đổi ip (đơn vị là giây, vd: 180 = 180 giây)</label>
                                                            <input type="number" min="0" name="time" value="0" class="form-control" placeholder="Thiếp lập thời gian tự động đổi ip (đơn vị là giây, vd: 180 = 180 giây)"
                                                                value="">
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
                                                                value="">
                                                        </div>

                                                        <div id="userpass_section" style="display:none;">
                                                            <div class="mb-3">
                                                                <label class="form-label">Username</label>
                                                                <input type="text" name="username" value="" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Password</label>
                                                                <input type="text" name="password" value="{{ randomString(9) }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Xác nhận</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Đóng</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal " id="apiModal{{ $order->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('extend.run', $order->id) }}"
                                                    class="modal-content">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">RUN API</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Xác nhận gia hạn gói proxy này!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Xác nhận</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Đóng</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

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


{{-- @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-service").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    console.log(123)

                    let parentCard = this.closest(".item");
                    let packageId, packageName, price;

                    if (this.getAttribute("data-type") === "select") {
                        let select = parentCard.querySelector(
                            "select[name='package_id']");
                        let selectedOption = select.options[select.selectedIndex];
                        packageId = selectedOption.value;
                        packageName = selectedOption.text;
                        price = selectedOption.getAttribute("data-price");
                    } else {
                        let input = parentCard.querySelector(
                            "input[name='package_id']");
                        packageId = input.value;
                        packageName = parentCard.querySelector(".price-tag").innerText;
                        price = input.getAttribute("data-price") || input
                            .value; // cần gắn thêm data-price khi render input
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

            // Ẩn hiện auth type
            let authIp = document.getElementById("auth_ip");
            let authUserpass = document.getElementById("auth_userpass");
            let ipSection = document.getElementById("ip_section");
            let userpassSection = document.getElementById("userpass_section");

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
@endpush --}}


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-service").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    console.log(123)

                    let parentCard = this.closest(".card-body");
                    let packageId, packageName, price;

                    if (this.getAttribute("data-type") === "select") {
                        let select = parentCard.querySelector(
                            "select[name='package_id']");
                        let selectedOption = select.options[select.selectedIndex];
                        packageId = selectedOption.value;
                        packageName = selectedOption.text;
                        price = selectedOption.getAttribute("data-price");
                    } else {
                        let input = parentCard.querySelector(
                            "input[name='package_id']");
                        packageId = input.value;
                        packageName = parentCard.querySelector(".price-tag").innerText;
                        price = input.getAttribute("data-price") || input
                            .value; // cần gắn thêm data-price khi render input
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

            // Ẩn hiện auth type
            let authIp = document.getElementById("auth_ip");
            let authUserpass = document.getElementById("auth_userpass");
            let ipSection = document.getElementById("ip_section");
            let userpassSection = document.getElementById("userpass_section");

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
@endpush
