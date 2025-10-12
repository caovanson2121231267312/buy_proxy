@extends('layouts.app_admin')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card card-primary card-outline mb-3 mt-3">
            <div class="card-header" bis_skin_checked="1">
                <div class="d-block mb-3 mt-3" bis_skin_checked="1">
                    <h4>Quản lý tài khoản</h4>
                </div>
                <div>
                    <form method="GET" action="{{ route('users.index') }}" class=" w-100">
                        <div class="row">
                            <div class="col-12 col-lg-3 mb-2">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Tìm kiếm theo tên hoặc email..." value="{{ request('search') }}">
                            </div>
                            <div class="col-12 col-lg-3 mb-2">
                                <input type="text" name="phone" class="form-control me-2"
                                    placeholder="Tìm kiếm theo phone..." value="{{ request('phone') }}">
                            </div>
                            <div class="col-12 col-lg-1 mb-2">
                                <select name="show" class="form-select me-2">
                                    <option value="10" @if (request('show') == 10) selected @endif>10</option>
                                    <option value="20" @if (request('show') == 20) selected @endif>20</option>
                                    <option value="50" @if (request('show') == 50) selected @endif>50</option>
                                    <option value="100" @if (request('show') == 100) selected @endif>100</option>
                                    <option value="1000" @if (request('show') == 1000) selected @endif>1000</option>
                                    <option value="1000000000" @if (request('show') == 1000000000) selected @endif>all
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-lg-3 row g-3 align-items-center mt-0 mb-2">
                                <div class="col-auto mt-0">
                                    <label for="inputPassword6" class="col-form-label">Sắp xếp</label>
                                </div>
                                <div class="col-auto mt-0">
                                    <select name="arrange" class="form-select me-2">
                                        <option value="1" @if (request('arrange') == 1) selected @endif>Mới nhất</option>
                                        <option value="2" @if (request('arrange') == 2) selected @endif>Cũ nhất</option>
                                        <option value="3" @if (request('arrange') == 3) selected @endif>Số dư</option>
                                        <option value="4" @if (request('arrange') == 4) selected @endif>Tổng nạp</option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>

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
                                <th>#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Số dư</th>
                                <th>Tổng nạp</th>
                                <th>Quyền</th>
                                <th>Xác thực tài khoản</th>
                                <th>Token</th>
                                <th>Ngày tạo</th>
                                <th width="300">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td>BUYPROXY{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                                    <td>{{ number_format($user->price, 0, ',', '.') }} đ</td>
                                    <td>{{ number_format($user->trans_sum_amount, 0, ',', '.') }} đ</td>
                                    <td>
                                        @if ($user->role == 0)
                                            <span class="badge text-bg-primary">Khách hàng</span>
                                        @else
                                            <span class="badge text-bg-primary">Quản trị viên</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($user->email_verified_at))
                                            <span class="text-danger">Chưa xác thực email</span>
                                        @else
                                            <span class="text-success">Đã xác thực email</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- {{ $user->token }} --}}
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <!-- Btn cập nhật -->
                                        <button class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#updateModalMoney{{ $user->id }}">
                                            Nạp - trừ tiền
                                        </button>

                                        <button class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $user->id }}">
                                            Sửa
                                        </button>

                                        <!-- Btn đổi mật khẩu -->
                                        <button class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal"
                                            data-bs-target="#passwordModal{{ $user->id }}">
                                            Đổi mật khẩu
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal " id="updateModalMoney{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('users.updateMoney', $user->id) }}"
                                                class="modal-content">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Nạp trừ tiền</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Số tiền:</label>
                                                        <input type="number" name="price" min="0"
                                                            class="form-control" value="0" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Loại </label>
                                                        <select name="type" class="form-control">
                                                            <option value="0">Nạp tiền
                                                            </option>
                                                            <option value="1">Trừ tiền
                                                            </option>
                                                        </select>
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

                                <!-- Modal cập nhật -->
                                <div class="modal " id="updateModal{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('users.update', $user->id) }}"
                                                class="modal-content">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cập nhật User</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Tên</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $user->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Email</label>
                                                        <input type="email" name="email" readonly
                                                            class="form-control" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Số điện thoại</label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ $user->phone }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Quyền</label>
                                                        <select name="role" class="form-control">
                                                            <option value="0"
                                                                @if ($user->role == 0) selected @endif>Khách
                                                                hàng
                                                            </option>
                                                            <option value="1"
                                                                @if ($user->role == 1) selected @endif>Quản trị
                                                                viên
                                                            </option>
                                                        </select>
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

                                <!-- Modal đổi mật khẩu -->
                                <div class="modal " id="passwordModal{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('users.changePassword', $user->id) }}"
                                                class="modal-content">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Đổi mật khẩu</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Mật khẩu mới</label>
                                                        <input type="password" name="password" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nhập lại mật khẩu</label>
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Đổi mật khẩu</button>
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

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
