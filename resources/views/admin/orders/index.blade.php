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
    <style>
    .payload-card {
        background: #fafafa;
        transition: all 0.25s ease;
    }

    .payload-card:hover {
        background: #f0f7ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);
    }

    .payload-line {
        margin-bottom: 6px;
        font-size: 14px;
    }

    .payload-line code {
        font-family: monospace;
    }

    .copy-btn {
        cursor: pointer;
        color: #007bff;
        transition: 0.2s;
    }

    .copy-btn:hover {
        color: #0056b3;
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
                                {{-- <th>Mã đăng ký</th> --}}
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
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#detailOrder{{ $order->id }}">Chi tiết</button>
                                                {{-- @if (!empty($order->payload_data))
                                                    <div class="payload-box table-cell-collapsed"
                                                        id="payload-{{ $order->id }}">
                                                        @foreach ($order->payload_data as $item)
                                                            <ul style="margin:0; padding-left: 15px;">
                                                                @if ($order->type == 1)
                                                                     <li><b>http(s):</b> 
                                                                        {{$item['public_origin_ip']}}:{{ $item['https_port'] ?? $item['port'] }}{{ empty($item['username']) ? '' : (':'.$item['username'] . ':') }}{{ empty($item['password']) ? '' : ($item['password'] ) }}
                                                                        <span title="Copy" class="ms-2 cs" onclick="copyText('{{$item['public_origin_ip']}}:{{ $item['https_port'] ?? $item['port'] }}{{ empty($item['username']) ? '' : (':'.$item['username'] . ':') }}{{ empty($item['password']) ? '' : ($item['password'] ) }}')"> <i class="bi bi-clipboard"></i></span>
                                                                    </li>
                                                                @else
                                                                <li><b>http(s):</b> 
                                                                        {{$item['public_origin_ip']}}:{{ $item['https_port'] ?? $item['port'] }}{{ empty($item['username']) ? '' : (':'.$item['username'] . ':') }}{{ empty($item['password']) ? '' : ($item['password'] ) }}
                                                                        <span title="Copy" class="ms-2 cs" onclick="copyText('{{$item['public_origin_ip']}}:{{ $item['https_port'] ?? $item['port'] }}{{ empty($item['username']) ? '' : (':'.$item['username'] . ':') }}{{ empty($item['password']) ? '' : ($item['password'] ) }}')"> <i class="bi bi-clipboard"></i></span>
                                                                    </li>
                                                                @endif
 

                                                                @if(!empty($item['package_api_key']))
                                                                    <li><b>Package api key:</b> {{ $item['package_api_key'] }}</li>
                                                                @endif

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

                                                                @if(!empty($item['https_port']))
                                                                    <li><b>Port https:</b> {{ $item['https_port'] }}</li>
                                                                @endif
               

                                                                @if(!empty($item['proxy_auth_ip']))
                                                                    <li><b>Proxy Auth IP:</b> {{ $item['proxy_auth_ip'] }}</li>
                                                                @endif

                        
                                                            </ul>
                                                        @endforeach

                                                    </div>
                                                    <button type="button" class="btn btn-link btn-sm toggle-payload"
                                                        data-target="payload-{{ $order->id }}">
                                                        Xem thêm
                                                    </button>
                                                @endif --}}
            
                                        </td>
                                        {{-- <td>
                               
                                                @if (!empty($order->payload_data))
                                                    <div class=""
                                                        id="payload-{{ $order->id }}">
                                                        @foreach ($order->payload_data as $item)
                                                    
                                                        @if(!empty($item['id']))
                                                            {{ $item['id'] }}
                                                        @endif
                                                   
                                                        @endforeach
                                                @endif
                                        </td> --}}
                                    <td>{{ $order->end_date ? $order->end_date->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $order->created_at ? $order->created_at->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editOrder{{ $order->id }}">Sửa</button>
                                    </td>
                                </tr>
                              
                                <div class="modal fade" id="detailOrder{{ $order->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                    <h5 class="modal-title">Chi tiết Order #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                               <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
    @if (!empty($order->payload_data))
        @foreach ($order->payload_data as $key => $item)
            <div class="payload-card p-3 mb-3 shadow-sm border rounded">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-primary">#{{ $key + 1 }}</span>
                    <span class="badge bg-light text-dark">
                        {{ $order->type == 1 ? 'HTTP(S)' : 'SOCKS' }}
                    </span>
                </div>

                <div class="payload-line">
                    <b class="text-secondary">Proxy:</b>
                    <code class="text-dark bg-light px-2 py-1 rounded d-inline-block">
                        {{ $item['public_origin_ip'] }}:{{ $item['https_port'] ?? $item['port'] }}
                        {{ empty($item['username']) ? '' : (':' . $item['username'] . ':') }}
                        {{ empty($item['password']) ? '' : $item['password'] }}
                    </code>
                    <span class="copy-btn ms-2" title="Copy"
                        onclick="copyText('{{ $item['public_origin_ip'] }}:{{ $item['https_port'] ?? $item['port'] }}')">
                        <i class="bi bi-clipboard"></i>
                    </span>
                </div>

                @if(!empty($item['package_api_key']))
                    <div class="payload-line">
                        <b class="text-secondary">Package API Key:</b>
                        <span class="text-dark">{{ $item['package_api_key'] }}</span>
                    </div>
                @endif

                @if(!empty($item['domain']))
                    <div class="payload-line">
                        <b class="text-secondary">Domain:</b>
                        <span class="text-dark">{{ $item['domain'] }}</span>
                    </div>
                @endif

                @if(!empty($item['id']))
                    <div class="payload-line">
                        <b class="text-secondary">Mã đăng ký:</b>
                        <span class="fw-semibold text-success">{{ $item['id'] }}</span>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="text-center text-muted py-3">
            Không có dữ liệu hiển thị
        </div>
    @endif
</div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

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
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                toastr.success("Đã copy: " + text);
            }).catch(err => {
                console.error("Copy thất bại", err);
            });
        }
    </script>

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
