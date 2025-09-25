@extends('layouts.app_admin')

@section('content')
    <style>
        :root {
            --primary: #4361ee;
            --success: #06d6a0;
            --info: #118ab2;
            --warning: #ffd166;
            --danger: #ef476f;
            --dark: #073b4c;
            --secondary: #8d99ae;
        }

        .dashboard-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .stat-title {
            font-size: 14px;
            color: #6c757d;
            font-weight: 500;
        }

        .table-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .table-card .card-header {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .badge {
            padding: 0.5em 0.8em;
            border-radius: 6px;
            font-weight: 500;
        }

        .recent-table {
            font-size: 0.9rem;
        }

        .recent-table tbody tr {
            transition: background-color 0.2s;
        }

        .recent-table tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>

    {{-- <div class="container-fluid mt-4">
    <div class="row">
        <!-- Tổng Orders -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng đơn hàng</h5>
                    <p class="card-text h3">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>

        <!-- Doanh thu -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Doanh thu</h5>
                    <p class="card-text h3">{{ number_format($totalRevenue,0,',','.') }} ₫</p>
                </div>
            </div>
        </div>

        <!-- Orders đang hoạt động -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng hoạt động</h5>
                    <p class="card-text h3">{{ $activeOrders }}</p>
                </div>
            </div>
        </div>

        <!-- Orders hết hạn -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng hết hạn</h5>
                    <p class="card-text h3">{{ $expiredOrders }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Nạp tiền -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng nạp</h5>
                    <p class="card-text h3">{{ number_format($totalDeposit,0,',','.') }} ₫</p>
                </div>
            </div>
        </div>

        <!-- Rút tiền -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng rút</h5>
                    <p class="card-text h3">{{ number_format($totalWithdraw,0,',','.') }} ₫</p>
                </div>
            </div>
        </div>

        <!-- Giao dịch pending -->
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Giao dịch chờ</h5>
                    <p class="card-text h3">{{ $pendingTrans }}</p>
                </div>
            </div>
        </div>

        <!-- Người dùng -->
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <p class="card-text h3">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Giao dịch gần đây -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header"><h5>Giao dịch gần đây</h5></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Loại</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentTransactions as $t)
                                <tr>
                                    <td>{{ $t->user->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $t->type=='deposit'?'success':'danger' }}">
                                            {{ $t->type }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($t->amount,0,',','.') }} ₫</td>
                                    <td>
                                        @if ($t->status == 'success')
                                            <span class="badge bg-success">Thành công</span>
                                        @elseif($t->status=='failed')
                                            <span class="badge bg-danger">Thất bại</span>
                                        @else
                                            <span class="badge bg-warning">Chờ xử lý</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Đơn hàng gần đây -->
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header"><h5>Đơn hàng gần đây</h5></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Gói</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Ngày</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $o)
                                <tr>
                                    <td>{{ $o->user->name ?? '-' }}</td>
                                    <td>{{ $o->proxy_id }}</td>
                                    <td>{{ $o->quantity }}</td>
                                    <td>{{ number_format($o->total_price,0,',','.') }} ₫</td>
                                    <td>{{ $o->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <section class="content">
        <div class="container-fluid py-4 px-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold">Dashboard</h2>
                    <p class="text-muted">Tổng quan hệ thống và thống kê</p>
                </div>
            </div>

            <!-- Hàng thứ nhất: Tổng đơn hàng, Doanh thu, Đơn hàng hoạt động, Đơn hàng hết hạn -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h5 class="stat-title">TỔNG ĐƠN HÀNG</h5>
                            <p class="stat-number">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h5 class="stat-title">DOANH THU</h5>
                            <p class="stat-number">{{ number_format($totalRevenue, 0, ',', '.') }} ₫</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-info bg-opacity-10 text-info">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="stat-title">ĐƠN HÀNG HOẠT ĐỘNG</h5>
                            <p class="stat-number">{{ $activeOrders }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-danger bg-opacity-10 text-danger">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h5 class="stat-title">ĐƠN HÀNG HẾT HẠN</h5>
                            <p class="stat-number">{{ $expiredOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hàng thứ hai: Tổng nạp, Tổng rút, Giao dịch chờ, Người dùng -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <h5 class="stat-title">TỔNG NẠP</h5>
                            <p class="stat-number">{{ number_format($totalDeposit, 0, ',', '.') }} ₫</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <h5 class="stat-title">TỔNG RÚT</h5>
                            <p class="stat-number">{{ number_format($totalWithdraw, 0, ',', '.') }} ₫</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-secondary bg-opacity-10 text-secondary">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5 class="stat-title">GIAO DỊCH CHỜ</h5>
                            <p class="stat-number">{{ $pendingTrans }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card bg-white">
                        <div class="card-body">
                            <div class="card-icon bg-dark bg-opacity-10 text-dark">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="stat-title">NGƯỜI DÙNG</h5>
                            <p class="stat-number">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hàng thứ ba: Bảng dữ liệu -->
            <div class="row">
                <!-- Giao dịch gần đây -->
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="table-card card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Giao dịch gần đây</h5>
                                <a href="{{ route('transactions.index') }}" target="_blank" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover recent-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Loại</th>
                                            <th>Số tiền</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentTransactions as $t)
                                            <tr>
                                                <td>{{ $t->user->name ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $t->type == 'deposit' ? 'success' : 'danger' }}">
                                                        {{ $t->type == 'deposit' ? 'Nạp tiền' : 'Rút tiền' }}
                                                    </span>
                                                </td>
                                                <td>{{ number_format($t->amount, 0, ',', '.') }} ₫</td>
                                                <td>
                                                    @if ($t->status == 'success')
                                                        <span class="badge bg-success">Thành công</span>
                                                    @elseif($t->status == 'failed')
                                                        <span class="badge bg-danger">Thất bại</span>
                                                    @else
                                                        <span class="badge bg-warning">Chờ xử lý</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Đơn hàng gần đây -->
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="table-card card">
                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Đơn hàng gần đây</h5>
                                <a href="{{ route('orders.index') }}" target="_blank" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover recent-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Gói</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                            <th>Ngày</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $o)
                                            <tr>
                                                <td>{{ $o->user->name ?? '-' }}</td>
                                                <td>{{ $o->proxy_id }}</td>
                                                <td>{{ $o->quantity }}</td>
                                                <td>{{ number_format($o->total_price, 0, ',', '.') }} ₫</td>
                                                <td>{{ $o->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
