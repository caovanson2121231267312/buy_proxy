@extends('layouts.app_admin')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card card-primary card-outline mb-3 mt-3">
            <div class="card-header" bis_skin_checked="1">
                <div class="d-block mb-3 mt-3" bis_skin_checked="1">
                    <h4>Quản lý proxy</h4>
                </div>
                <div>
                    <form method="GET" action="{{ route('proxy.index') }}" class=" w-100">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Tìm kiếm theo loại gói..." value="{{ request('search') }}">
                            </div>
                            <div class="col-12 col-lg-3">
                                <input type="text" name="package_code" class="form-control me-2"
                                    placeholder="Tìm kiếm theo mã gói..." value="{{ request('package_code') }}">
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
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Gói dịch vụ</th>
                            <th>Chuyên đề</th>
                            <th>Loại</th>
                            <th>Mã gói</th>
                            <th>Tên gói</th>
                            <th>Thời gian 1 (expiry_time)</th>
                            <th>Thời gian 2 (use_time_min)</th>
                            <th width="100">Giá</th>
                            <th>Trang thái</th>

                            <th width="100">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->proxy_type }}</td>
                                <td>{{ $value->api_call->title }}</td>
                                <td>{{ $value->proxy_type_name }}</td>
                                <td>{{ $value->package_code }}</td>
                                <td>{{ $value->package_name }}</td>
                                <td>{{ $value->expiry_time }}</td>
                                <td>{{ $value->use_time_min }}</td>
                                <td>
                                    <p class="fw-bold text-danger d-inline-block">
                                        {{ number_format($value->price, 0, ',', '.') . ' ₫' }}
                                    </p>
                                </td>
                                <td>
                                    @if ($value->status == 0)
                                        <span class="badge rounded-pill bg-warning text-white">Tạm ngừng</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Hoạt động</span>
                                    @endif
                                </td>
                                <td>

                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $value->id }}">
                                        Sửa
                                    </button>

                                </td>
                            </tr>

                            <div class="modal " id="updateModal{{ $value->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('proxy.update', $value->id) }}"
                                            class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cập nhật Gói proxy</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Tên gói</label>
                                                    <input type="text" name="package_name" class="form-control"
                                                        value="{{ $value->package_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Giá</label>
                                                    <input type="text" name="price" class="form-control"
                                                        value="{{ $value->price }}" required>
                                                </div>
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

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
