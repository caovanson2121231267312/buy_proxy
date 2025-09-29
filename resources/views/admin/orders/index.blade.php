@extends('layouts.app_admin')

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
    </style>
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h4>Quản lý đơn mua</h4>
                <form method="GET" action="{{ route('orders.index') }}" class="row mt-2">
                    <div class="col-3">
                        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên, email..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-3">
                        <input type="text" name="orders" class="form-control" placeholder="Tìm theo Mã đơn..."
                            value="{{ request('orders') }}">
                    </div>
                    <div class="col-3">
                        <input type="date" name="date" class="form-control" placeholder="Tìm theo date..."
                            value="{{ request('date') }}">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th width="120">Nguồn</th>
                                <th  width="550">User</th>
                                <th width="550">Proxy</th>
                                <th width="550">SL mua</th>
                                <th>Auth</th>
                                <th>IP/User</th>
                                <th>Gia hạn</th>
                                <th width="420">Thông tin đăng ký</th>
                                <th>Mã đăng ký</th>
                                <th>Ngày Hết hạn</th>
                                <th>Ngày mua</th>
                                <th width="120">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ "MD" . $order->id }}</td>
                                    <td>
                                        @if ($order->proxy->api_call->id == 1)
                                            <span class="text-success">{{ $order->proxy->api_call->title }}</span>
                                        @else
                                            <span class="text-info">{{ $order->proxy->api_call->title }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <div>{{ $order->user->name ?? '-' }} <b>[{{ $order->user->id }}]</b></div>
                                            <div>Số dư: <i>{{ number_format($order->user->price, 0, ',', '.') }}</i></div>
                                            <div>Tổng nạp: <i>{{ number_format($order->user->trans_sum_amount, 0, ',', '.') }}</i></div>
                                        </div>
                                    </td>
                                    <td>{{ $order->proxy->package_name ?? '-' }}</td>
                                    <td>
                                        <div>
                                            <div>Số lượng: {{ $order->quantity }}</div>
                                            <div>Giá/1: {{ number_format($order->unit_price, 0, ',', '.') }} ₫</div>
                                            <div>Tổng: <b class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }} ₫</b></div>
                                        </div>
                                    </td>
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
                                    <td>{{ $order->created_at ? $order->created_at->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editOrder{{ $order->id }}">Sửa</button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="editOrder{{ $order->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('orders.update', $order->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cập nhật Order #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Ngày hết hạn</label>
                                                        <input type="date" name="end_date" class="form-control"
                                                            value="{{ $order->end_date?->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Số lượng</label>
                                                        <input type="number" name="quantity" class="form-control"
                                                            value="{{ $order->quantity }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Đơn giá</label>
                                                        <input type="number" name="unit_price" class="form-control"
                                                            value="{{ $order->unit_price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tổng tiền</label>
                                                        <input type="number" name="total_price" class="form-control"
                                                            value="{{ $order->total_price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Auth Type</label>
                                                        <select name="auth_type" class="form-control">
                                                            <option value="ip"
                                                                {{ $order->auth_type == 'ip' ? 'selected' : '' }}>
                                                                IP</option>
                                                            <option value="userpass"
                                                                {{ $order->auth_type == 'userpass' ? 'selected' : '' }}>
                                                                User/Pass
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>IP Address</label>
                                                        <input type="text" name="ip_address" class="form-control"
                                                            value="{{ $order->ip_address }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Username</label>
                                                        <input type="text" name="username" class="form-control"
                                                            value="{{ $order->username }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Password</label>
                                                        <input type="text" name="password" class="form-control"
                                                            value="{{ $order->password }}">
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="auto_renew" value="1"
                                                            class="form-check-input" id="autoRenew{{ $order->id }}"
                                                            {{ $order->auto_renew ? 'checked' : '' }}>
                                                        <label for="autoRenew{{ $order->id }}"
                                                            class="form-check-label">Tự
                                                            động gia hạn</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Lưu</button>
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

                <div class="d-flex justify-content-end mt-3">
                    {{ $orders->links() }}
                </div>
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
