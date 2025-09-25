@extends('layouts.app_admin')

@section('content')
    <style>
        .text {
            width: 200px;
            /* chiều rộng khung chứa */
            white-space: nowrap;
            /* không xuống dòng */
            overflow: hidden;
            /* ẩn phần vượt quá */
            text-overflow: ellipsis;
            /* thêm ... */
            display: inline-block;
            vertical-align: middle;
        }

        .min-w {
            min-width: 200px;
        }
    </style>
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card card-primary card-outline mb-3 mt-3">
            <div class="card-header" bis_skin_checked="1">
                <div class="d-block mb-3 mt-3" bis_skin_checked="1">
                    <h4>Quản lý API</h4>
                </div>
                <div>
                    <form method="GET" action="{{ route('api.index') }}" class=" w-100">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <input type="text" name="token" class="form-control me-2"
                                    placeholder="Tìm kiếm theo token..." value="{{ request('token') }}">
                            </div>
                            <div class="col-12 col-lg-3">
                                <input type="text" name="title" class="form-control me-2"
                                    placeholder="Tìm kiếm theo chuyên đề..." value="{{ request('title') }}">
                            </div>
                            <div class="col-12 col-lg-4">
                                <button type="submit" class="btn btn-primary me-2"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                                {{-- <button type="button" class="btn btn-success"  data-bs-toggle="modal"
                                        data-bs-target="#updateModalAPI"><i class="fa-solid fa-download"></i> API RUN</button> --}}
                            </div>

                        </div>


                    </form>
                </div>
            </div>

            <div class="modal " id="updateModalAPI" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('proxy.create') }}" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Đấu API call data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Token API:</label>
                                    <input type="text" name="token" class="form-control"
                                        value="9bcd2ff417b78f413e4e0ef5e7f46ada" required>
                                </div>
                                <div class="mb-3">
                                    <label>API Link:</label>
                                    <input type="text" name="link" class="form-control"
                                        value="https://api.m2proxy.com/user/data/getpackages?token=" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">RUN</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th class="min-w">API</th>
                                <th>Chuyên mục</th>
                                <th>Số dư</th>
                                <th class="min-w">Thống kê</th>
                                <th class="min-w">Chi tiết</th>
                                <th>Trạng thái</th>
                                <th>Cập nhật lúc</th>
                                <th width="200">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        <div>
                                            <b>Link call:</b>
                                            <a class="text" target="_bank"
                                                href="{{ $value->link . $value->token }}">{{ $value->link }}</a>
                                        </div>
                                        <div>
                                            <b>Token: </b>
                                            <span class="text">{{ $value->token }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ number_format($value->price, 0, ',', '.') . ' ₫' }}</td>
                                    <td>
                                        <div>
                                            <b>Proxy đang hoạt động: </b>
                                            <span type="button" class="text-info">
                                                {{ $value->proxy_1_count }}
                                            </span>
                                        </div>
                                        <div>
                                            <b>Proxy đang tạm ngưng: </b>
                                            <span type="button" class="text-danger">
                                                {{ $value->proxy_0_count }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <div>
                                                <b>Tăng giá: </b>
                                                <span type="button" class="text-info">
                                                    {{ $value->price_increase }} %
                                                </span>
                                            </div>
                                            <div>
                                                <b>Cập nhật lại tên: </b>
                                                @if ($value->content_type == 0)
                                                    <span type="button" class="text-danger">Off</span>
                                                @else
                                                    <span type="button" class="text-success">On</span>
                                                @endif
                                            </div>
                                            <div>
                                                <b>Làm tròn giá: </b>
                                                <span type="button" class="text-success">
                                                    @if ($value->price_type == 0)
                                                        Giữ nguyên
                                                    @elseif ($value->price_type == 1)
                                                        Làm tròn lên
                                                    @else
                                                        Làm tròn xuống
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($value->status == 0)
                                            <span class="badge rounded-pill bg-warning text-white">Tạm ngừng</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">Hoạt động</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->updated_at }}</td>
                                    <td>

                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#updateModal{{ $value->id }}">
                                            Sửa
                                        </button>

                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#apiModal{{ $value->id }}">
                                            RUN API
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal " id="updateModal{{ $value->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('api.update', $value->id) }}"
                                                class="modal-content">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cập nhật Gói proxy</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>Chuyền đề</label>
                                                                <input type="text" name="title" class="form-control"
                                                                    value="{{ $value->title }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>Tăng giá</label>
                                                                <input type="number" min="0"
                                                                    name="price_increase" class="form-control"
                                                                    value="{{ $value->price_increase }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>API</label>
                                                                <input type="text" name="link" class="form-control"
                                                                    value="{{ $value->link }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>Token</label>
                                                                <input type="text" name="token" class="form-control"
                                                                    value="{{ $value->token }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>Làm tròn giá</label>
                                                                <select name="price_type" class="form-control">
                                                                    <option value="0"
                                                                        @if ($value->price_type == 0) selected @endif>
                                                                        Giữ
                                                                        nguyên
                                                                    </option>
                                                                    <option value="1"
                                                                        @if ($value->price_type == 1) selected @endif>
                                                                        Làm
                                                                        tròn lên
                                                                    </option>
                                                                    <option value="2"
                                                                        @if ($value->price_type == 2) selected @endif>
                                                                        Làm
                                                                        tròn xuống
                                                                    </option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>Tự động cập nhật lại tên</label>
                                                                <select name="content_type" class="form-control">
                                                                    <option value="1"
                                                                        @if ($value->content_type == 1) selected @endif>
                                                                        On
                                                                    </option>
                                                                    <option value="0"
                                                                        @if ($value->content_type == 0) selected @endif>
                                                                        Off
                                                                    </option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label>Trạng thái</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="0"
                                                                        @if ($value->status == 0) selected @endif>
                                                                        Tạm
                                                                        ngừng
                                                                    </option>
                                                                    <option value="1"
                                                                        @if ($value->status == 1) selected @endif>
                                                                        Hoạt
                                                                        động
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

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

                                <div class="modal " id="apiModal{{ $value->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('api.run', $value->id) }}"
                                                class="modal-content">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">RUN API</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Xác nhận chạy đồng bộ data theo cấu hình API bạn đã đặt!
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

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
