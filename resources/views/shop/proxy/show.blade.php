@extends('layouts.app')

@section('content')
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
    <div class="container mt-4">
        <div class="header-section">
            <h1>DỊCH VỤ CAO CẤP CỦA CHÚNG TÔI</h1>
            <p>Khám phá các gói dịch vụ <b class="fw-bold">{{ $data_name->proxy_type_name }}</b> chất lượng cao với mức giá
                hợp lý và nhiều ưu đãi đặc biệt dành riêng cho bạn</p>
        </div>

        <div class="my-3 mx-4">
            <div class="row justify-content-center">

                <?php
                function render($item)
                {
                    $html = '';
                    if (in_array($item->proxy_type, ['RAND_COUNTRY_ROTATING', 'EU_ROTATING', 'US_4G_ROTATING', 'VN_VIETTEL_ROTATING', 'VN_VNPT_ROTATING', 'VN_FPT_ROTATING', 'VN_ISPDC_ROTATING', 'US_ROTATING', 'US_STATIC_RESIDENTIAL', 'US_V6_ROTATING', 'VN_V6_ROTATING', 'VN_MOBILE_4G_VINA_ROTATING', 'VN_ROTATING', 'VN_STATIC_PRIVATE', 'VN_STATIC_RESIDENTIAL', 'VN_VIP_PROVIDER_ROTATING'])) {
                        $html .= '📅 Gói ' . $item->expiry_time . ' ngày - ' . number_format($item->price, 0, ',', '.') . 'đ';
                    }

                    return $html;
                }
                ?>

                @foreach ($data as $value)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card service-card h-100">
                            <span class="discount-badge">HOT</span>
                            <div class="card-body text-center p-4">

                                @if (str_contains($data_name->package_name, 'USA'))
                                    <div class="service-icon-1">
                                        <img class="w-100" src="{{ asset('assets/559553.png') }}" alt="">
                                    </div>
                                @elseif (str_contains($data_name->package_name, 'EU') || str_contains($data_name->package_name, 'Quốc gia'))
                                    <div class="service-icon-1">
                                        <img class="w-100" src="{{ asset('assets/images.png') }}" alt="">
                                    </div>
                                @else
                                    <div class="service-icon-1">
                                        <img class="w-100" src="{{ asset('assets/istockphoto-864417828-612x612.jpg') }}"
                                            alt="">
                                    </div>
                                @endif

                                <h4 class="fw-bold">
                                    {{ $data_name->api_id == 2 ? $value->package_name : $value[0]->package_name }}</h4>
                                <div></div>
                                <div class="">
                                    <div>
                                        @if ($data_name->api_id == 1)
                                            <div class="price-tag">Chọn gói dịch vụ</div>

                                            <select name="package_id" class="form-select">
                                                @foreach ($value as $item)
                                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                                        {{ render($item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <div class="price-tag">
                                                {{ $value->package_name . ' - ' . number_format($value->price, 0, ',', '.') }}
                                                đ</div>

                                            <input type="text" name="package_id" hidden value="{{ $value->id }}">
                                        @endif
                                    </div>
                                </div>
                                <ul class="feature-list mt-4">
                                    <li><i class="fas fa-check-circle"></i> Hỗ trợ API</li>
                                    <li><i class="fas fa-check-circle"></i> Giao thức HTTP/HTTPS</li>
                                    <li><i class="fas fa-check-circle"></i> Băng thông Không giới hạn</li>
                                    <li><i class="fas fa-check-circle"></i> Hỗ trợ 24/7</li>
                                    <li><i class="fas fa-check-circle"></i> IP Dân cư đa dạng: Đủ các dải IP mà hiện tại các
                                        nhà mạng cung cấp</li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-service"
                                    data-type="{{ $data_name->api_id == 1 ? 'select' : 'input' }}">
                                    Đăng ký ngay
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

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
                                        <label class="form-label">Số lượng</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            value="1" min="1">
                                    </div>

                                    <div class="mb-3">
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
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="auto_renew"
                                            name="auto_renew">
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
            </div>
        </div>

    </div>
@endsection


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
