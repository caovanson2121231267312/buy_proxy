@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header  bg-danger text-white fw-bold">
                <strong>User Token</strong>
            </div>
            <div class="card-body d-flex align-items-center">
                <input type="text" class="form-control me-2" value="{{ $user->token }}" readonly>
                <form action="{{ route('user.token.regenerate') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width: 100px">Đổi token</button>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-success text-white fw-bold">
                Danh sách API <small class="text-light">(cập nhật mới nhất: 22/08/2025)</small>
            </div>
            <div class="card-body">
                <div class="accordion" id="apiAccordion">

                    <!-- 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne">
                                1. Lấy danh sách proxy của user đã mua
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Lấy danh sách proxy đã mua trên hệ thống
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input value="https://buyproxy.vn/api/user/data/getlistproxy?token=USER_TOKEN"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>USER_TOKEN</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>c4ca4238a0b923820dcc509a6f75849b</td>
                                                <td>Mã khóa truy cập của tài khoản đã đăng ký trên hệ thống (tìm user token
                                                    tại mục tích hợp API)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/data/getlistproxy?token=c4ca4238a0b923820dcc509a6f75849b</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công",
  "Data": [
    {
      "id": 100,
      "proxy_type": "VN_ROTATING",
      "package_name": "Đổi IP 4 Phút (1 Ngày)",
      "package_api_key": "202cb962ac59075b964b07152d234b70",
      "auto_renew": true,
      "public_ip": "127.0.0.1",
      "public_origin_ip": "103.222.222.222",
      "http_port": 8000,
      "https_port": 8000,
      "change_ip_time": 60,
      "next_change_ip_time": 10,
      "proxy_auth_type": "IP_ADDRESS",
      "proxy_auth_ip": "192.168.0.1",
      "expired_date": "2024-04-01T00:43:17.1563843",
      "note": "ghi chú"
    }
  ]
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Token không hợp lệ"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo">
                                2. Đổi IP mới cho proxy
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Cho phép thay đổi sang 1 địa chỉ ip khác
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input
                                            value="https://buyproxy.vn/api/user/package/changeip?package_api_key=PACKAGE_API_KEY"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PACKAGE_API_KEY</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>887eb3cbd3123d76ca601c0dad8ecfb4</td>
                                                <td>Mã khóa của gói đăng ký (xem ở danh sách các gói đã đăng ký)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/package/changeip?package_api_key=887eb3cbd3123d76ca601c0dad8ecfb4</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công"
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Vui lòng chờ sau 180 giây"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree">
                                3. Thay đổi cấu hình proxy
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Cho thay đổi cấu hình của proxy như: kiểu
                                        xác thực hoặc cấu hình tự động đổi ip,....</div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input
                                            value="https://buyproxy.vn/api/user/package/edit?package_api_key=PACKAGE_API_KEY&amp;proxy_auth_type=PROXY_AUTH_TYPE&amp;proxy_auth_ip=PROXY_AUTH_IP&amp;proxy_auth_username=PROXY_AUTH_USER&amp;proxy_auth_password=PROXY_AUTH_PASSWORD&amp;auto_changeip_time=AUTO_CHANGEIP_TIME&amp;auto_renew=AUTO_RENEW"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PACKAGE_API_KEY</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>887eb3cbd3123d76ca601c0dad8ecfb4</td>
                                                <td>Mã khóa của gói đăng ký (xem ở danh sách các gói đã đăng ký)</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_TYPE</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>IP_ADDRESS</td>
                                                <td>Loại xác thực cho proxy, có 2 loại:<br><b>IP_ADDRESS:</b> xác thực bằng
                                                    địa chỉ ip<br><b>USER_PASS:</b> xác thực username và password</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_IP</td>
                                                <td>string</td>
                                                <td>Bắt buộc khi<br>PROXY_AUTH_TYPE là IP_ADDRESS</td>
                                                <td>127.0.0.1</td>
                                                <td>Địa chỉ ip dùng để xác thực proxy</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_USER</td>
                                                <td>string</td>
                                                <td>Bắt buộc khi<br>PROXY_AUTH_TYPE là USER_PASS</td>
                                                <td>admin123</td>
                                                <td>Tên tài khoản dùng để xác thực proxy</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_PASSWORD</td>
                                                <td>string</td>
                                                <td>Bắt buộc khi<br>PROXY_AUTH_TYPE là USER_PASS</td>
                                                <td>pass123</td>
                                                <td>Mật khẩu dùng để xác thực proxy</td>
                                            </tr>
                                            <tr>
                                                <td>AUTO_CHANGEIP_TIME</td>
                                                <td>string</td>
                                                <td>KHÔNG</td>
                                                <td>180</td>
                                                <td>Thiếp lập thời gian tự động đổi ip (đơn vị là giây, vd: 180 = 180
                                                    giây)<br><b>Lưu ý:</b> thời gian không được nhỏ hơn thời gian cho phép
                                                    đổi cho gói</td>
                                            </tr>
                                            <tr>
                                                <td>AUTO_RENEW</td>
                                                <td>boolean</td>
                                                <td>KHÔNG</td>
                                                <td>true</td>
                                                <td>Có tự động gia hạn hay không?<br><b>true:</b> tự động gia
                                                    hạn<br><b>false:</b> không tự động gia hạn</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/package/edit?package_api_key=887eb3cbd3123d76ca601c0dad8ecfb4&amp;proxy_auth_type=IP_ADDRESS&amp;proxy_auth_ip=127.0.0.1&amp;proxy_auth_username=admin123&amp;proxy_auth_password=pass123&amp;auto_changeip_time=180&amp;auto_renew=true</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công"
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Vui lòng nhập đầy đủ các thông tin bắt buộc"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bạn thêm các mục 4-7 tương tự -->

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse4">
                                4. Gia hạn proxy
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Gia hạn thêm thời gian sử dụng proxy</div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input
                                            value="https://buyproxy.vn/api/user/package/renew?package_api_key=PACKAGE_API_KEY"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>PACKAGE_API_KEY</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>887eb3cbd3123d76ca601c0dad8ecfb4</td>
                                                <td>Mã khóa của gói đăng ký (xem ở danh sách các gói đã đăng ký)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/package/renew?package_api_key=887eb3cbd3123d76ca601c0dad8ecfb4</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công",
  "Data": [
    {
      "package_id": 100,
      "package_name": "Đổi IP Dân cư Việt Nam 4 Phút (1 Ngày)",
      "expired_date": "2024-12-09T23:01:43.2262566",
      "payment_amount": 6000
    }
  ]
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Số dư không đủ để gia hạn, vui lòng nạp thêm"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse5">
                                5. Lấy danh sách các gói proxy của hệ thống
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Lấy danh sách các gói proxy hiện có trên hệ
                                        thống</div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input value="https://buyproxy.vn/api/user/data/getpackages?token=USER_TOKEN"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>USER_TOKEN</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>c4ca4238a0b923820dcc509a6f75849b</td>
                                                <td>Mã khóa truy cập của tài khoản đã đăng ký trên hệ thống (tìm user token
                                                    tại mục tích hợp API)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/data/getpackages?token=c4ca4238a0b923820dcc509a6f75849b</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công",
  "Data": [
    {
      "package_code": "P0012",
      "package_name": "Đổi IP Dân cư Việt Nam 4 Phút (1 Ngày)",
      "price": 6000,
      "expiry_time": 1,
      "use_time_min": 240,
      "proxy_type": "VN_ROTATING",
      "proxy_type_name": "Proxy Xoay Dân cư/4G Việt Nam"
    }
  ]
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số response:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>package_code</td>
                                                <td>string</td>
                                                <td>Mã gói proxy, dùng để truyền vào tham số khi mua gói proxy mới qua API
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>package_name</td>
                                                <td>string</td>
                                                <td>Tên của gói proxy trên hệ thống</td>
                                            </tr>
                                            <tr>
                                                <td>price</td>
                                                <td>number</td>
                                                <td>Giá gói proxy (<b>đơn vị: vnđ</b>)</td>
                                            </tr>
                                            <tr>
                                                <td>expiry_time</td>
                                                <td>number</td>
                                                <td>Số ngày hết hạn của gói proxy (<b>đơn vị: ngày</b>)</td>
                                            </tr>
                                            <tr>
                                                <td>use_time_min</td>
                                                <td>number</td>
                                                <td>Thời gian được phép đổi IP mới kể từ lần đổi IP gần nhất (<b>đơn vị:
                                                        giây</b>)</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_type</td>
                                                <td>string</td>
                                                <td>Mã loại proxy (VN/US/...)</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_type_name</td>
                                                <td>string</td>
                                                <td>Tên loại proxy</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Token không hợp lệ"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse6">
                                6. Mua gói proxy
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Cho phép người dùng đăng ký các gói proxy
                                        mới</div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input
                                            value="https://buyproxy.vn/api/user/data/buypackage?token=USER_TOKEN&amp;package_code=PACKAGE_CODE&amp;qty=QTY&amp;auto_renew=AUTO_RENEW&amp;time_auto_change_ip=TIME_AUTO_CHANGE_IP"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>USER_TOKEN</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>c4ca4238a0b923820dcc509a6f75849b</td>
                                                <td>Mã khóa truy cập của tài khoản đã đăng ký trên hệ thống (tìm user token
                                                    tại mục tích hợp API)</td>
                                            </tr>
                                            <tr>
                                                <td>PACKAGE_CODE</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>P0010</td>
                                                <td>Mã gói proxy cần mua (lấy từ api: Lấy danh sách các gói proxy của hệ
                                                    thống)</td>
                                            </tr>
                                            <tr>
                                                <td>QTY</td>
                                                <td>number</td>
                                                <td>KHÔNG</td>
                                                <td>1</td>
                                                <td>Số lượng mua (không bắt buộc truyền, nếu không truyền mặc định là 1)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>AUTO_RENEW</td>
                                                <td>boolean</td>
                                                <td>KHÔNG</td>
                                                <td>true</td>
                                                <td>Có tự động gia hạn hay không?<br><b>true:</b> tự động gia
                                                    hạn<br><b>false:</b> không tự động gia hạn</td>
                                            </tr>
                                            <tr>
                                                <td>TIME_AUTO_CHANGE_IP</td>
                                                <td>number</td>
                                                <td>KHÔNG</td>
                                                <td>180</td>
                                                <td>Thiếp lập thời gian tự động đổi ip (đơn vị là giây, vd: 180 = 180
                                                    giây)<br><b>Lưu ý:</b> thời gian không được nhỏ hơn thời gian cho phép
                                                    đổi cho gói</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_TYPE</td>
                                                <td>string</td>
                                                <td>KHÔNG</td>
                                                <td>USER_PASS</td>
                                                <td>Loại xác thực cho proxy, có 2 loại:<br><b>IP_ADDRESS:</b> xác thực bằng
                                                    địa chỉ ip<br><b>USER_PASS:</b> xác thực username và password</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_IP</td>
                                                <td>string</td>
                                                <td>Bắt buộc khi<br>PROXY_AUTH_TYPE là IP_ADDRESS</td>
                                                <td>127.0.0.1</td>
                                                <td>Địa chỉ ip dùng để xác thực proxy</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_USER</td>
                                                <td>string</td>
                                                <td>Bắt buộc khi<br>PROXY_AUTH_TYPE là USER_PASS</td>
                                                <td>admin123</td>
                                                <td>Tên tài khoản dùng để xác thực proxy</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_AUTH_PASSWORD</td>
                                                <td>string</td>
                                                <td>Bắt buộc khi<br>PROXY_AUTH_TYPE là USER_PASS</td>
                                                <td>pass123</td>
                                                <td>Mật khẩu dùng để xác thực proxy</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_COUNTRY</td>
                                                <td>string</td>
                                                <td>Bắt buộc nhập đối với các proxy cho phép chọn Quốc gia (bổ sung ngày
                                                    02/06/2025)</td>
                                                <td>VN</td>
                                                <td>Mã Quốc gia của proxy, danh sách các Quốc gia vui lòng xem API số 7</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/data/buypackage?token=c4ca4238a0b923820dcc509a6f75849b&amp;package_code=P0010&amp;qty=1&amp;auto_renew=true&amp;time_auto_change_ip=180</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công",
  "Data": [
    {
      "id": 209,
      "proxy_type": "VN_ROTATING",
      "package_name": "Đổi IP Dân cư Việt Nam 4 Phút (1 Ngày)",
      "package_api_key": "be03176e7873cd8fc62b5aaafa21c234",
      "auto_renew": true,
      "public_ip": "s1.m2proxy.com",
      "public_origin_ip": "103.222.222.222",
      "http_port": 8136,
      "https_port": 8136,
      "change_ip_time": 60,
      "next_change_ip_time": 0,
      "proxy_auth_type": "IP_ADDRESS",
      "proxy_auth_ip": "127.0.0.1",
      "expired_date": "2024-04-11T20:10:37.1987999"
    }
  ]
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số response:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>id</td>
                                                <td>number</td>
                                                <td>Mã khóa duy nhất của gói</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_type</td>
                                                <td>string</td>
                                                <td>Mã loại proxy (VN/US/...)</td>
                                            </tr>
                                            <tr>
                                                <td>package_name</td>
                                                <td>string</td>
                                                <td>Tên gói đã đăng ký</td>
                                            </tr>
                                            <tr>
                                                <td>package_api_key</td>
                                                <td>string</td>
                                                <td>Mã khóa api của gói, dùng trong tích hợp API</td>
                                            </tr>
                                            <tr>
                                                <td>auto_renew</td>
                                                <td>boolean</td>
                                                <td>Tự động gia hạn (<b>true:</b> có, <b>false:</b> không)</td>
                                            </tr>
                                            <tr>
                                                <td>public_ip</td>
                                                <td>string</td>
                                                <td>Host/ip dùng để connect đến proxy</td>
                                            </tr>
                                            <tr>
                                                <td>public_origin_ip</td>
                                                <td>string</td>
                                                <td>IP gốc của proxy (không domain)</td>
                                            </tr>
                                            <tr>
                                                <td>http_port</td>
                                                <td>number</td>
                                                <td>Port http của proxy, sử dụng cho các website có giao thức http</td>
                                            </tr>
                                            <tr>
                                                <td>https_port</td>
                                                <td>number</td>
                                                <td>Port http của proxy, sử dụng cho các website có giao thức https</td>
                                            </tr>
                                            <tr>
                                                <td>change_ip_time</td>
                                                <td>number</td>
                                                <td>Thời gian được phép đổi ip mới kể từ lần đổi cuối cùng</td>
                                            </tr>
                                            <tr>
                                                <td>next_change_ip_time</td>
                                                <td>number</td>
                                                <td>Thời gian còn lại sẽ được phép thay đổi ip mới</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_auth_type</td>
                                                <td>string</td>
                                                <td>Kiểu xác thực của proxy: IP_ADDRESS hoặc USER_PASS</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_auth_ip</td>
                                                <td>string</td>
                                                <td>Địa chỉ IP hiện tại dùng để xác thực proxy (khi xác thực bằng
                                                    IP_ADDRESS)</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_auth_username</td>
                                                <td>string</td>
                                                <td>Tài khoản dùng để xác thực proxy (khi xác thực bằng USER_PASS)</td>
                                            </tr>
                                            <tr>
                                                <td>proxy_auth_password</td>
                                                <td>string</td>
                                                <td>Mật khẩu dùng để xác thực proxy (khi xác thực bằng USER_PASS)</td>
                                            </tr>
                                            <tr>
                                                <td>expired_date</td>
                                                <td>datetime</td>
                                                <td>Ngày hết hạn của proxy</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Tài khoản không đủ số dư để đăng ký, vui lòng nạp thêm"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse7">
                                7. Lấy danh sách các Quốc gia của proxy
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#apiAccordion">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="fw-bold fst-italic">Mô tả API: Danh sách các Quốc gia được phép chọn khi
                                        mua proxy (chỉ đối với các proxy hỗ trợ chọn Quốc gia khi mua như: Proxy V6 VIP) (bổ
                                        sung ngày 02/06/2025)</div>
                                    <div class="fw-bold fst-italic mt-2">Method: GET</div>
                                    <div class="fw-bold fst-italic mt-2">Api Url:</div>
                                    <div>
                                        <input
                                            value="https://buyproxy.vn/api/user/data/getcountry?token=USER_TOKEN&amp;proxy_type=PROXY_TYPE"
                                            class="form-control url rounded-1 shadow-none text-primary" readonly="">
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Giải thích tham số:</div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên tham số</th>
                                                <th>Kiểu dữ liệu</th>
                                                <th>Bắt buộc</th>
                                                <th>Ví dụ</th>
                                                <th>Mô tả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>USER_TOKEN</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>c4ca4238a0b923820dcc509a6f75849b</td>
                                                <td>Mã khóa truy cập của tài khoản đã đăng ký trên hệ thống (tìm user token
                                                    tại mục tích hợp API)</td>
                                            </tr>
                                            <tr>
                                                <td>PROXY_TYPE</td>
                                                <td>string</td>
                                                <td>CÓ</td>
                                                <td>CHOOSE_COUNTRY_V6_ROTATING</td>
                                                <td>Mã loại proxy hỗ trợ chọn Quốc gia, hiện tại hỗ trợ với các loại proxy
                                                    sau: <br><b><i>CHOOSE_COUNTRY_V6_ROTATING</i>: Proxy V6 VIP</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="fw-bold fst-italic mt-2">Request ví dụ:</div>
                                    <div>
                                        <pre class="request-example text-primary">https://buyproxy.vn/api/user/data/getcountry?token=c4ca4238a0b923820dcc509a6f75849b&amp;proxy_type=CHOOSE_COUNTRY_V6_ROTATING</pre>
                                    </div>

                                    <div class="fw-bold fst-italic mt-2">Response thành công:</div>
                                    <div>
                                        <pre class="json-format text-success">{
  "Status": "Success",
  "Message": "Thành công",
  "Data": [
    {
      "proxy_type": "CHOOSE_COUNTRY_V6_ROTATING",
      "country": "VN",
      "name": "Việt Nam"
    },
    {
      "proxy_type": "CHOOSE_COUNTRY_V6_ROTATING",
      "country": "US",
      "name": "Mỹ"
    }
  ]
}</pre>
                                    </div>
                                    <div class="fw-bold fst-italic mt-2">Response thất bại:</div>
                                    <div>
                                        <pre class="json-format text-danger">{
  "Status": "Error",
  "Message": "Không tìm thấy Quốc gia hỗ trợ cho loại proxy này"
}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                </div>
            </div>
        </div>

    </div>
@endsection
