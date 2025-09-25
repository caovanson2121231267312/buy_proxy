@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row">
        <!-- Bảng thông tin ngân hàng -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center fw-bold">
                    Kiểm tra kỹ thông tin trước khi chuyển khoản
                </div>
                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Ngân hàng</th>
                                <td>
                                    {{-- <img src="{{ asset('assets/logo-vietcombank-inkythuatso-10-10-41-18.jpg') }}"
                                         alt="MB Bank" style="height:25px;"> --}}
                                    <span class="fw-bold text-primary">{{ $bank_name }} bank</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Tên tài khoản</th>
                                <td class="fw-bold text-uppercase text-primary">PHAM HONG SON</td>
                            </tr>
                            <tr>
                                <th>Số tài khoản</th>
                                <td class="fw-bold">{{ $accountNo }}</td>
                            </tr>
                            <tr>
                                <th>Nội dung chuyển khoản</th>
                                <td class="fw-bold text-danger">{{ 'BUYPROXY' . auth()->user()->id }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <p class="fw-bold text-danger">***Hướng dẫn***</p>
                        <ol>
                            <li>Sử dụng tính năng quét QR trên các app bank hoặc ví điện tử.</li>
                            <li>Quét mã QR thanh toán bên trên.</li>
                            <li>Kiểm tra lại thông tin và chuyển khoản.</li>
                            <li>Sau khi chuyển thành công chờ tầm 2 phút tiền sẽ tự động cộng vào tài khoản,
                                nếu sau 5 phút chưa được cộng thì liên hệ admin.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR code -->
        <div class="col-md-4 text-center">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <p class="fw-bold">QR hỗ trợ tất cả ngân hàng và ví điện tử</p>
                    <img src="{{ $qr_img }}"
                         alt="QR Code" class="img-fluid mb-3">
                    <p class="text-muted">
                        <i class="spinner-border spinner-border-sm text-warning"></i>
                        Đang chờ chuyển khoản
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
